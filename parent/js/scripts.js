//JQUERY FUNCTIONALITY
$(document).ready(function(){



    //EDITOR CKEDITOR
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );
    
    //REST OF THE CODE

    $('#selectAllBoxes').click(function(event){

        if(this.checked) {

        $('.checkBoxes').each(function(){
    
            this.checked = true;
    
        });
    
    } else {
    
        $('.checkBoxes').each(function(){
    
            this.checked = false;
    
        });
    
    
        }
    
        }); //selectAllCheckBoxes


        // //Javascriptvariable witht the divs
        // var div_box = "<div id='load-screen'><div id='loading'></div></div>"; 
        // //prepend the divs to the body
        // $("body").prepend(div_box);

        // //Muestra el item por .6 segundos y luego fadeout y remueve
        // $('#load-screen').delay(700).fadeout(600, function(){
        //     $(this).remove();
        // });










    
    }); //doccument.ready
    
    