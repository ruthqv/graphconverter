  <template>
  <div @click="exportimage()" class="btn btn-default">
  <i class="fa fa-download"></i>
  <span class="hidden-xs hidden-sm ml5">Export as png</span>
  </div>  	
  </template>
  <script>
 export default {
	props:['idtoexport'],

	methods:{
  	   exportimage: function () {
  	   	console.log(this.idtoexport) 	

        let canvas = document.getElementById(this.idtoexport).toDataURL('image/png')
        let link = document.createElement('a')
        link.download = this.idtoexport
        link.href = canvas
        link.click()
      }, 
	} 
}	
 
  </script>



