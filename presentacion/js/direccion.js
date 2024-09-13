// JavaScript Document
function dir()
{
	var via=$('#VIA').val();
	var dt_via=$('#detalle_via').val();
	var num1=$('#numero').val();
	var num2=$('#numero2').val();
	var interior=$('#interior').val();
	var dt_interior=$('#detalle_int').val();
	var interior2=$('#interior2').val();
	var dt_interior2=$('#detalle_int2').val();
	var interior3=$('#interior3').val();
	var dt_interior3=$('#detalle_int3').val();
	if(interior!='')
	{
		$("#detalle_int").removeAttr('readonly');
	}
	else if(interior=='')
	{
		$("#detalle_int").attr('readonly','readonly');
		$("#detalle_int").val('');
		var dt_interior='';
	} 
	if(interior2!='')
	{
		$("#detalle_int2").removeAttr('readonly');
	}
	else if(interior2=='')
	{
		$("#detalle_int2").attr('readonly','readonly');
		$("#detalle_int2").val('');
		var dt_interior2='';
	} 
	if(interior3!='')
	{
		$("#detalle_int3").removeAttr('readonly');
	}
	else if(interior3=='')
	{
		$("#detalle_int3").attr('readonly','readonly');
		$("#detalle_int3").val('');
		var dt_interior3='';
	} 
	if(num1!=''||num2!='')
	{
	  $('#DIRECCION').val(via+' '+dt_via+'  # '+num1+' - '+num2+' '+interior+' '+dt_interior+' '+interior2+' '+dt_interior2+' '+interior3+' '+dt_interior3);
	}
	else
	{
	  $('#DIRECCION').val(via+' '+dt_via+' '+interior+' '+dt_interior+' '+interior2+' '+dt_interior2+' '+interior3+' '+dt_interior3);
	}
}

function direccion()
{
	//alert('ok2');
	var via=$('#VIA').val();
	var dt_via=$('#detalle_via').val();
	$('#VIA').change(function()
	{
		dir();
	});
	$('#detalle_via').change(function()
	{
		dir();
	});
	$('#numero').change(function()
	{
		dir();
	});
	$('#numero2').change(function()
	{
		dir();
	});
	$('#interior').change(function()
	{
		dir();		
	});
	$('#detalle_int').change(function()
	{
		dir();
	});
	$('#interior2').change(function()
	{
		dir();		
	});
	$('#detalle_int2').change(function()
	{
		dir();
	});
	$('#interior3').change(function()
	{
		dir();		
	});
	$('#detalle_int3').change(function()
	{
		dir();
	});
}