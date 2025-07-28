<form method="post" name="formMenu" id="formMenu"></form>
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>

    //LEMBRAR DE MUDAR O VALUE PARA $ID!!!!!!!!!!!!!!!!!!!
function ev(vArq,vValores){
    $('#formMenu').append('<input type="hidden" name="i" id="i" value="1" />');			
    if(vValores!==undefined){				
        var vArr = vValores.split("&");				
        for(var i=0; i<vArr.length; i++){
            var vArrPar = vArr[i].split("=>");					
            $('#formMenu').append('<input type="hidden" name="'+vArrPar[0]+'" value="'+vArrPar[1]+'" />');
        }
    }			
    $("#formMenu").attr('action',vArq);
    $("#formMenu").submit();
}
</script>