import R from 'ramda';

export const JsonParseOrFalse = (json) => {
	try {
		return JSON.parse(json);
	} catch(e) {
		return false;
	}
};

const unboundSlice = Array.prototype.slice;
export const toArray = Function.prototype.call.bind(unboundSlice);


export const nestedPropToUpperLevel = R.curry((prop_path, return_map_as, obj) => {
	let prop = R.path(prop_path, obj);
	let new_obj = R.clone(obj);
	new_obj[return_map_as] = prop;
	return new_obj;
});

//doubleMapNestedAndReturnInUpperLevel:: [paths] -> [paths] -> String -> [{prop: nested_target:[{finaltarget:'value'}]}] -> [{String:[mapped_values]}]
export const doubleMapNestedAndReturnInUpperLevel = R.curry((prop_path, mapped_prop_path, return_map_as, obj_array) =>
	R.map(obj => {
		obj[return_map_as] =
			R.map(mapped_prop =>
				R.pathOr([], mapped_prop_path, mapped_prop),
				R.pathOr([], prop_path, obj)
			);
		return obj;
	})(obj_array || []));

export const pairWith = R.curry((id_prop, prop, obj) => [obj[id_prop], obj[prop]]);
export const pairWithObj = R.curry((id_prop, props, obj) => [obj[id_prop],R.pick(props, obj)]);
export const pairObjToIdProp = R.curry((id_prop, obj) => [obj[id_prop], obj]);


export const objsById = (id_prop, obj) => R.compose(R.fromPairs, R.map(pairObjToIdProp(id_prop)))(obj)

export const mergeObj = (k, l, r) =>  R.merge(l, r);

export const arrsIntoObjs = R.map(x => R.fromPairs([x]));

export const toArrIfNotArr = (x) => R.not(Array.isArray(x)) ? R.of(x) : x;

export const concatValuesToArrayIfDuplicateKeys = (k, l, r) => {
  if(!Array.isArray(l)){l = [l];}
  if(!Array.isArray(r)){r = [r];}
    return  R.concat(l,r);
};

export const objFromPairs = function(arr){return {[arr[0]]: arr[1]}};

export const provisionedFromPairs = function(arr_of_arrs) {
	let arr_of_objs = R.map( objFromPairs , arr_of_arrs);
	return R.map(toArrIfNotArr, R.reduce(R.mergeWithKey(concatValuesToArrayIfDuplicateKeys), {}, arr_of_objs));
};

//idsByParentIds :: [{parent_id, id}] -> {some_parent_id: [ids], another_parent_id: [ids]}
export const idsByParentIds = (parent_id_prop, id_prop, arr) =>
	R.compose(
		provisionedFromPairs,
		R.map( pairWith(parent_id_prop, id_prop) )
	)(arr)

export const logEach = R.forEach((el)=> console.log(el));

export const toNumber = R.flip(R.curry(parseInt))(10);

export const denullify = v => v === null ? '': v;

export const deundefinedify  = v => v === undefined ? '': v;

export const removeNullsAndUndefineds = R.compose(denullify, deundefinedify);

export const lensPropMaker = lens_arr => R.mergeAll(R.map((elem) =>  ({[elem]: R.lensProp(elem)}), lens_arr));

/**
 * Moves the element at the selected index up or down by the number stated in the direction parameter.
 * Note that: If direction - $index < 0 then the element will be positioned at the end of the array, if the index es bigger than the lenght of the array an udefined element will be created
 * @todo Correct the errors stated in the previous note
 * @param  {Int} direction position relative to the index by which the element will be moved
 * @param  {Int} index    the element
 * @param  {Array} array
 * @return {Array}
 */
export const moveInArray = (direction, index, array) => R.insert(index+direction, array[index], R.remove(index, 1, array));

//same a moveInArray, but prevents the first element of the array from becoming the last one when direction + index is less than  0
export const nonCyclingMoveInArray = (direction, index, array) => {
	if(index + direction < 0 || index+direction > array.length -1) {
		return array
	} else {
		return moveInArray(direction, index, array);
	}

}

// A different API for the same operation as moveInArray.
// removeAndInsert :: event {oldIndex, newIndex} -> [] -> []
export const removeAndInsert = R.curry((event, list) => {
	let moved_elem = list[event.oldIndex];
 	let remove = R.remove(event.oldIndex, 1);
 	let insert = R.insert(event.newIndex, moved_elem);
 	return R.compose (insert, remove)(list);
});

export const uppercaseFirst = s => R.join('', R.over(R.lensIndex(0), R.toUpper)(s));

export const diff = function(a, b) { return a - b; };
export const orderAscending = R.sort(diff);

export const sortByFirstItem = R.sortBy(R.prop(0));

/**
 * Logs within a composed function
 * @link http://ramdajs.com/0.22.1/docs/#tap
 * @param  {[type]} x [description]
 * @return {[type]}   [description]
 */
export const tapLog = R.tap(x=>console.log(x));

export const logAndReturnSomething = (message, something) => {
	if (process.env.NODE_ENV) {
		console.log(message);
	}
	return something;
}
/**
 *
 * [obj_prop_string] -> [a] -> [a]
 *
 * Sorts alphabetically ignoring case.
 *
 * @example alphabeticalObjSort(path_arr)(arr)
 *
 * @param  {array} path_arr an array of strings
 * @return {array}          sorted array
 */
export const alphabeticalObjSort = R.curry((path_arr, sortable_objs) =>
	 Array.isArray(path_arr) && path_arr.length > 0 ?
	 	R.sortBy(R.compose(R.toLower, R.path(path_arr)))(sortable_objs) :
	 	logAndReturnSomething(`the first argument of alphabeticalObjSort must be and array of length > 0, '${path_arr}' given`, sortable_objs)
);

/**
 *
 * [obj_prop_string] -> [a] -> [a]
 *
 * Sorts numerically.
 * *
 * @param  {array} path_arr an array of strings
 * @return {array}          sorted array
 */
export const numericalObjSort = R.curry((path_arr, asc_or_desc, sortable_objs) =>
	Array.isArray(path_arr) && path_arr.length > 0
		? R.compose(
	 		sortingOrder(asc_or_desc),
	 		 R.sortBy(
	 		 	R.path(path_arr)
	 		 )
	 	)(sortable_objs)
	 	: logAndReturnSomething(`the first argument of numericalObjSort must be and array of length > 0, '${path_arr}' given`, sortable_objs)
);

export const sortingOrder =  R.curry((asc_or_desc, arr) => {
	if (asc_or_desc === 'desc') {
		return R.reverse(arr);
	} else if (asc_or_desc === 'asc') {
		return arr;
	}
	return logAndReturnSomething(`th argument 'asc_or_desc' must receive the string 'asc' or 'desc', ${asc_or_desc}' given. No ordering was done`, arr);
});


export const defaultTo1 = val =>
	val === null ||
	val === undefined
	? 1
	: val;

/**
 * If quantity is missing it defaults to 1
 *
 */
export const defaultIndexTo1 = index => R.over(R.lensIndex(index), defaultTo1);



//sumTotal:: String prop -> String prop ->[{Number price, Int quantity}] -> Number price
export const sumTotal = R.curry((quantity_prop, sumable_prop) =>
	R.compose(
		R.sum,
		R.map (
			R.compose(
				R.product,
				R.map(Number),
				defaultIndexTo1(0),
				R.props([quantity_prop, sumable_prop])
			)
		)
	)
);

/**
 * Calculates the total price of an array of objects with props price and quantity.
 * If quantity is missing it defaults to 1
 * Includes a function to parse stringed numbers R.ma(Number)
 * @function sumTotalPrice
 * @requires  defaultIndexTo1
 * @requires  _prices_times_quantitites
 * @test http://goo.gl/fcglnD or http://ramdajs.com/repl/#?code=%2F%2Fhelpers%0Avar%20tapLog%20%3D%20R.tap%28x%3D%3Econsole.log%28x%29%29%3B%0Avar%20_%20%3D%20R%0A%0A%2F%2Ffunction%0Avar%20defaultTo1%20%3D%20val%20%3D%3E%20val%20%3D%3D%3D%20null%20%7C%7C%20val%20%3D%3D%3D%20undefined%20%3F%201%20%3A%20val%3B%0Avar%20defaultIndexTo1%20%3D%20index%20%3D%3E%20_.over%28_.lensIndex%28index%29%2C%20defaultTo1%29%3B%0Avar%20_prices_times_quantities%20%3D%20_.map%28_.compose%28_.reduce%28_.multiply%2C%201%29%2C%20_.map%28Number%29%2C%20defaultIndexTo1%281%29%2C%20_.props%28%5B%27price%27%2C%20%27quantity%27%5D%29%20%29%29%0Avar%20sumTotalPrice%20%3D%20_.compose%28_.sum%2C%20_prices_times_quantities%29%3B%20%0AsumTotalPrice%28%5B%7Bprice%3A1%2C%20quantity%3A5%7D%2C%20%7Bprice%3A%221%22%2C%20quantity%3A%20undefined%7D%5D%29%0A
 */
//sumTotalPrice:: [{Number price, Int quantity}] -> Number price
export const sumTotalPrice = sumTotal('price', 'quantity');



// additiveFilter:: ['path'] -> [b] -> [{ ['path'] : [b], ...}] -> [{ Path [a] : [b], ...}]
export const additiveFilter = R.curry((filter_prop_path, categories, categorizable_objs)=> {
	let notEmpty = obj =>
		R.intersection(
			R.path(filter_prop_path, obj),
			categories
		).length > 0
			? true
			: false;

	if(categories.length === 0 )
		return categorizable_objs;
	else
		return R.filter(notEmpty, categorizable_objs);
});

// rangeFilter::  ['path'] ->  [num, num] -> [{ ['path'] : num }] ->[{ ['path'] : num }]
export const rangeFilter = R.curry((filter_prop_path, from_to_arr, filterable_objs) => {
	let 	both_ends_are_0 = from_to_arr[0] == 0 && from_to_arr[1] == 0,
		range_is_numerical = isNumber(from_to_arr[0]) &&  isNumber(from_to_arr[1]),
		inverted_range = from_to_arr[1] < from_to_arr[0],
		range_is_incomplete = from_to_arr.length !== 2,
		inRange = obj =>
			R.path(filter_prop_path, obj) >= from_to_arr[0] &&
			R.path(filter_prop_path, obj) <= from_to_arr[1];

	if(//si no debe filtrarse por alguna razón
		both_ends_are_0 ||
		!range_is_numerical ||
		inverted_range ||
		range_is_incomplete) {

		 return filterable_objs;

	} else  {
		return R.filter(obj =>
			R.path(filter_prop_path, obj) === undefined
				? obj
				:  inRange(obj),
		filterable_objs)
	}
});

//isNumber :: a -> Bool
export const isNumber = n =>
	typeof !isNaN(Number(n)) &&
	n !== '' &&
	n !== null &&
	n !== undefined;

export const inString = R.curry((test_string, string) =>
	R.test(
		new RegExp(test_string, 'i'),
		string)
	);

export const objTextFilter = R.curry((filter_prop_path, string, filterable_objs) =>
	string !== ''
		? R.filter(obj =>
				inString(
					string,
					R.path(filter_prop_path, obj)
				)
		  )(filterable_objs)
		: filterable_objs
);

export const multiTextFilter2 = R.curry((filters, string, filterable_objs) =>
R.filter(obj=>
	R.reduce((bool, filter)=> filter(string, obj) || bool, false, filters),
	filterable_objs
)
)
//validateEmail :: String email -> Bool
export const validateEmail = email => R.test(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/, email);

// pathHasString :: Path [string] -> String search -> Obj {path: String} -> Bool
export const pathHasString = R.curry((prop_path, string, obj) =>
	inString(
		string,
		R.path(prop_path, obj)
	)
);

// stringInPathOfObjArray :: [Path string] -> [Path string] -> String -> {path_to_array: [ {path_to_text: String} ]} -> Bool
export const stringInPathOfObjArray = R.curry((path_to_array, path_to_text, string, obj) =>
	R.compose(
		R.any(R.equals(true)),
		R.map(pathHasString(path_to_text, string)),
		R.pathOr([], path_to_array)
	)(obj)
);

// substringInStringArray :: { path: [String], * } -> Bool
export const substringInStringArray = R.curry((path, string, obj) =>
	R.compose(
		inString(string),//buscamos
		R.join(''),//unimos
		//R.map(s => typeof s === 'string' ? s : ''), //TODO aseguramos que sea un string... mejor implementarlo con un Maybe
		R.pathOr([], path)//buscamos el array
	)(obj)
);
