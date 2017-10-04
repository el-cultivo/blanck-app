<div class=" mt-5 mb-5">
	<select v-model="filter_by" class="col s10 offset-s1 offset-l1 l3 mb-5">
		<option value="" default disabled>Selecciona un filtro</option>
		<option  v-for="option in filters" :value="$key" v-text="option.description"></option>
	</select>
	<input v-model="search"  class="offset-l2 col s10 offset-s1 l5 mb-5" placeholder="Buscar" type="text" >
</div>
