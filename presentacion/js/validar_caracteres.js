// JavaScript Document
function filtro(val)
{
	//alert('yes');
	var e=event.keyCode;
	if(e=='13'||e=='116'||e=='189'||e=='109'||e=='110'||e=='190'||e=='100')
	{
		return true;
	}
	/*EVITAR COPIAR-PEGAR
	if(val=='2')
	{
		if(e=='17'||e=='18')
		{
			return false;
		}
		if (event.ctrlKey==true && (event.which == '118' || event.which == '86'||event.which == '67'||event.which == '88')) 
		{
            return false;
         }
		if(e=='67'||e=='88'||e=='86')
		{
			return true;
		}
	}*/
	if(e==219)
	{
		return false;
	}
	if (e==186||e==222) 
	{
		alert('Caracter invalido.');
		return false;
	}
	if(e==37||e==39||e==9||e==38||e==40)
	{
		return true;
	}
	if (event.shiftKey == false)
	{
		if (e==8 || e==32 || e==35 || e==36 || e==46 || (e>=48 && e<=57) || (e>=65 && e<=90) || (e>=96 && e<=105))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}