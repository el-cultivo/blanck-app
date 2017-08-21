<div class="row content">
	<select v-model="filter_by" class="col s4">
		<option value="" default disabled>Selecciona un filtro</option>
		<option  v-for="option in filters" :value="$key" v-text="option.description"></option>
	</select>
	<input v-model="search"  class="offset-s2 col s6" placeholder="Buscar" type="text" >
</div>
