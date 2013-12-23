 <!-- snow plugin -->

<script>

	$(document).ready(function(){
		//ls.registry.set('snowmax',5);	
	});

</script>

<script type="text/javascript" src="{cfg name='path.root.web'}/plugins/snow/templates/skin/default/js/snow.js"></script>  

   <script>
	$(document).ready(function(){
		
		snowmax = '{cfg name="plugin.snow.count"}';
                snowletter = '{cfg name="plugin.snow.letter"}';
                sinkspeed = '{cfg name="plugin.snow.speed"}';
                snowtype = '{cfg name="plugin.snow.font"}';
		snowmaxsize = '{cfg name="plugin.snow.maxsize"}';
                snowminsize = '{cfg name="plugin.snow.minsize"}';
                snowingzone = '{cfg name="plugin.snow.zone"}';
		for (i=0;i<=snowmax;i++) {
			//document.write("<span id='s"+i+"' style='position:absolute;top:-"+ls.snow.options.snowmaxsize+"'>"+ls.snow.options.snowletter+"</span>")
			$('body').append(
				$('<span/>',{
					id: 's'+i,
					'style': 'position:absolute;top:-'+snowmaxsize,
					text: snowletter
				})
			);
		}
		
		initsnow(snowmax);	
	});

</script>

  <!-- /snow plugin -->
