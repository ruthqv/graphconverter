
<template>
<div class="col-sm-12">
  
  <form id="search">
    Search <input class="form-control" name="query" v-model="searchQuery">
  </form>
  <Grid
    :data="gridData"
    :columns="gridColumns"
    :filter-key="searchQuery">
  </Grid>

  
</div>

</template>

<script>
import Grid from './Grid/Grid.vue'

var companies = window.companies;
for (let [key, value] of Object.entries(companies)) {
      var array = value;
}

var finalarray = [];

for (let [keys, values] of Object.entries(array)) {
     if(keys !== 'id' && keys !=='_id' ){

    finalarray.push(keys);
  }
}

var finalarraycount = finalarray.length

export default {

name:'ExcelList',
  
  data() {
      return {
        searchQuery: '',
        gridColumns: finalarray,
        gridData : companies
      } 
  },

  components: {
    Grid,
  }
}
</script>

<style>


table {
  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;
}

th {
  background-color: #42b983;
  color: rgba(255,255,255,0.66);
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

td {
  background-color: #f9f9f9;
}

th, td {
  min-width: 120px;
  padding: 10px 20px;
}

th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #fff;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #fff;
}

</style>