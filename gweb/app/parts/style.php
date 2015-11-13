<?php


switch (explode("/", $_SERVER['REQUEST_URI'])[2]) {
	
	//case 'trabajopadre':
	case 'trabajoadmin':
	//case 'entidad':
		echo '<style>
			  	.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
			  	.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
			  	.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
			  	.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; }
			  	.ui-tabs-vertical .ui-tabs-panel { padding-left: 15em;}


				#selectable .ui-selecting { background: #FECA40; }
				#selectable .ui-selected { background: #F39814; color: white; }
				#selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }

				div.scroll { width: 500px; height: 300px; overflow-y: scroll; }

  			</style>
			';

		break;

	case 'trabajoSU':
	//case 'entidad':
		echo '<style>
			  	.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
			  	.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
			  	.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
			  	.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; }
			  	.ui-tabs-vertical .ui-tabs-panel { padding-left: 15em;}


				#selectable .ui-selecting { background: #FECA40; }
				#selectable .ui-selected { background: #F39814; color: white; }
				#selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }

				div.scroll { width: 500px; height: 300px; overflow-y: scroll; }

  			</style>
			';

		break;
	
	default:

		//echo 'document.write(document.URL.split("/").reverse()[1]);';
	
		break;
}

echo '<br/>';



