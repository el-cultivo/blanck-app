import R from 'ramda';
import {JsonParseOrFalse} from '../functions/pure';
/**
 * Init all JSONable props on Vue Component
 * Importante: usar en el evento "create", para que si hay un v-for en el "ready", ésta no se haga sobre el JSON
 * @return [array]
 */
export const initPropsFromJSON = function(props_obj) {
	R.keys(props_obj).forEach((prop) => {
		var parsedJSON = JsonParseOrFalse(this[prop])
		if (parsedJSON) {
			this[prop] = parsedJSON;
		}
	});
};


export const turnInputTypeIntoNumber = selector => {
	var inputs = document.querySelectorAll(selector);
	R.forEach(input => input.setAttribute('type', 'number'), inputs)
};