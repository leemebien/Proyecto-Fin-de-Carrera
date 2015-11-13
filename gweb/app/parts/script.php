<?php 

echo '<script>';
//echo '\n';

switch (explode("/", $_SERVER['REQUEST_URI'])[2]) {
	
	case 'index':

		echo ' $(function() { 
					$( "#dialogInfoLogin" ).dialog({ 
						autoOpen: false, 
						show: { 
							effect: "blind", 
							duration: 300 
						}, 
						hide: { 
							effect: "explode", 
							duration: 300 
						}
					}); 

				}); ';

		break;
		
	case 'trabajo':

		echo '	$(document).ready(function() { 
					$( "#dialogo_samu, #dialog_samu" ).dialog({ 
						autoOpen: false, 
						modal: true, 
						show: { 
							effect: "blind", 
							duration: 300 
						}, 
						hide: { 
							effect: "explode", 
							duration: 300 
						}
					}); 
 
					$( "#opener_p, #opener_p2" ).click(function() { 
						$( "#dialogo_samu" ).dialog( "open" ); 
					}); 
					
					
					$( "#catalog" ).accordion(); 
    				$( "#catalog li" ).draggable({ 
      					appendTo: "body", 
      					helper: "clone"
    				}); 
    				$( "#cart ol" ).droppable({ 
      					activeClass: "ui-state-default", 
      					hoverClass: "ui-state-hover", 
      					accept: ":not(.ui-sortable-helper)", 
      					drop: function( event, ui ) { 
        					$( this ).find( ".placeholder" ).remove(); 
        					$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this ); 
      					},
      					out: function( event, ui ) { 
      						$( this ).find( ui.draggable.text() ).remove();
      					}
					}).sortable({ 
      					items: "li:not(.placeholder)", 
      					sort: function() {  
        					$( this ).removeClass( "ui-state-default" ); 
      					} 
    				}); 


					$(".arrastrable").draggable();
					
					$(".arrastrable").data("soltado", false);

					$(".suelta").data("numsoltar", 0);

					$(".suelta").droppable({ 
						drop: function( event, ui ) { 
      						if (!ui.draggable.data("soltado")){ 
         						ui.draggable.data("soltado", true); 
         						var elem = $(this); 
         						elem.data("numsoltar", elem.data("numsoltar") + 1) 
         						elem.html("Llevo " + elem.data("numsoltar") + " elementos soltados"); 
      						} 
   						}, 
   						out: function( event, ui ) { 
      						if (ui.draggable.data("soltado")){ 
         						ui.draggable.data("soltado", false); 
         						var elem = $(this); 
         						elem.data("numsoltar", elem.data("numsoltar") - 1); 
         						elem.html("Llevo " + elem.data("numsoltar") + " elementos soltados"); 
      						} 
   						} 
					});

					//soltar solo elementos rojos 
					$("#sueltarojo").droppable("option", "accept", ".rojo"); 
					//soltar solo elementos azules 
					$("#sueltaazul").droppable("option", "accept", ".azul");


				}); ';


		break;
		
	case 'trabajopadre':

		echo '  $(function() {
    				$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    				$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );


    				$( "#check" ).button();
				    $( "#format" ).buttonset();

				    $( "#check1" ).button({
				      	text: false,
				      	icons: {
					        primary: "ui-icon-circle-triangle-n"
				      	}
				    });

				    $( "#check2" ).button({
				      	text: false,
				      	icons: {
					        primary: "ui-icon-circle-triangle-s"
				      	}
				    });

				});';

		break;
		
	case 'trabajoprofe':

		echo '  $(function() {
    				

				});';

		break;
		
	case 'trabajoadmin':

		echo ' $(function() {
    				$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    				$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

					$( "#selectable" ).selectable({
					    stop: function() {
					        var result = $( "#select-result" ).empty();
					        $( ".ui-selected", this ).each(function() {

								var sel = $( "#selectable li div div #ui-selected" );

					          	var index = $( "#selectable li" ).index( this );
					          	result.append( " #" + ( index + 1 ) );
					        });

					    }
					});

				});';
		break;
		
	case 'trabajoSU':

		echo ' $(function() {
    				$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    				$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

					$( "#selectable" ).selectable({
					    stop: function() {
					        var result = $( "#select-result" ).empty();
					        $( ".ui-selected", this ).each(function() {

								var sel = $( "#selectable li div div #ui-selected" );

					          	var index = $( "#selectable li" ).index( this );
					          	result.append( " #" + ( index + 1 ) );
					        });

					    }
					});

				});';
		break;

	case 'entidad':
/*
		echo '  $(function() {
    				$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    				$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

    				$( "#accordion" ).accordion();


    				$( "#check" ).button();
				    $( "#format" ).buttonset();

				    $( "#check1" ).button({
				      	text: false,
				      	icons: {
					        primary: "ui-icon-circle-triangle-n"
				      	}
				    });

				    $( "#check2" ).button({
				      	text: false,
				      	icons: {
					        primary: "ui-icon-circle-triangle-s"
				      	}
				    });

				});';
*/
		break;
	
	default:

		//echo 'document.write(document.URL.split("/").reverse()[1]);';
	
		break;
}

echo '</script>';
echo '<br/>';