$(document).ready(function(){

    function listar_ventas(f1,f2,cp,ep,tp){
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_mganancia.php",
            data:{
                f1:f1,
                f2:f2,
                cp:cp,
                ep:ep,
                tp:tp,  
                opcion:"listarm"
            },
            success:function(response){
                console.log(response);
                response = response.trim();
                // if(response=='vacio'){
                //     $('#cuerpo_tabla_reve').html('');
                // }else{
                //     var registro=JSON.parse(response);
                //     var template='';
                //     for(z in registro){
                        
                //         var est=registro[z].estd;
                //         var nomest;
                //         var clien;

                //         if(est==1){  nomest="PAGADO"; clien=registro[z].nomc}
                //         if(est==2){  nomest="PENDIENTE"; clien=registro[z].nomd}

                //         template+=
                //         '<tr><td>'+registro[z].cod+
                //         '</td><td>'+registro[z].fec+
                //         '</td><td>'+clien+
                //         '</td><td>'+registro[z].nomp+
                //         '</td><td>'+registro[z].tpve+
                //         '</td><td>'+nomest+
                //         '</td><td>S/. '+registro[z].neto+
                //         '</td></tr>';
                //     }
                //     $('#cuerpo_tabla_reve').html(template);

                // }
            }
        })
    }

});