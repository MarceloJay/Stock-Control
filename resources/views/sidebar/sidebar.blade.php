

<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
    
        <div style="text-align:center;margin-top:20px;margin-bottom:20px;">
            <a href="">
                <span>Estoque</span>
                <img id="kds_logo" src=""/>
            </a>
        </div>
        <style>
            #kds_logo { width:80%; padding:20px; background:#fff; border-radius:10px; }
            .nav-sm #kds_logo { width:60px; padding:7px; }
        </style>

        <!-- menu profile quick info -->
        <!--
        <div class="profile clearfix">
            <div class="profile_pic">
            </div>
            <div class="profile_info">
            </div>
        </div>
        -->
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        
            <div class="menu_section">
                <h3>{{ __('views.backend.section.navigation.sub_header_0') }}</h3>
                <ul class="nav side-menu">

                    <li>
                        <a href="">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            Estoque 01
                        </a>
                    </li>

                        <li>
                        <a href="">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            Bebidas
                        </a>
                    </li>

                </ul>
            </div>
            
            <div class="menu_section" id="div-store-config">
                <h3>Produto01</h3>
                <ul class="nav side-menu">

                        <li id="li-global-search" class="">
                            <a href="">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Produto02
                            </a>
                        </li>
                        <li id="li-distributor" class="">
                            <a href="">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                Produto03
                            </a>
                        </li>
                        <li id="li-reseller" class="">
                            <a href="">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                Produto04
                            </a>
                        </li>
    
                        <li id="li-storegroup" class="">
                            <a href="">
                                <i class="fa fa-sitemap" aria-hidden="true"></i>
                                Produto05
                            </a>
                        </li>
                        <li id="li-store" class="">
                            <a href="">
                                <i class="fa fa-cutlery" aria-hidden="true"></i>
                                Produto06
                            </a>
                        </li>                                        
                    	<li id="li-markplace" class="">
                            <a href="">    
                                <i class="fa fa-cubes tab-icons" aria-hidden="true"></i>
                                Produto06
                        	</a>
                     </li> 
                    </ul>
                    
                    {{-- Set CSS to actual menu li ------------------------------- --}}
                    <input type="hidden" id="menu-link" value="">
                    {{-- ------------------------------- Set CSS to actual menu li --}}
                    
                    </div>
            
            <!-- do not remove this log -->
            <div id="log">&nbsp;</div>

            <div class="menu_section">
                <h3>Produto10</h3>
                <ul class="nav side-menu">
                  <li>
                      <a href="https://logiccontrols.com/" target="_blank" title="Logic Controls">
                        <img src="/images/logo_lc_white.png" style="width:16px;height:16px;margin-right:10px;margin-bottom:4px;">
                        Logic Controls
                      </a>
                  </li>
                </ul>
            </div>
            
        </div>
        <!-- /sidebar menu -->
    </div>
</div>


@section('styles')
    @parent
    
	<style>
        .main_menu_side .menu_section li a { font-size:16px; font-weight:200; }
        .side-menu li.hover { border-right: 5px solid #1ABB9C; background: rgba(255, 255, 255, 0.02); }
        .side-menu li.selected  { border-right: 5px solid #1ABB9C; background: rgba(255, 255, 255, 0.05); }
    </style>
@endsection

@section('scripts')
    @parent
    
    <script type="text/javascript">

		$(function(){
			
			// Hover and Click Menu li
            	$('.side-menu').find('li').each(function(){
            		$(this).hover(function(){
            				$(this).addClass('hover');
            			},function(){
            				$(this).removeClass('hover');
            			}
            		);
            	});

            	// function setMenuCSS() {
                // 	var selectedPage = $("#menu-link").val();
                // 	if(selectedPage != '' && selectedPage != 'stores') {
                // 		$("#li-"+selectedPage).addClass('selected');
                // 	}
            	// }
            
            	// setMenuCSS();
                
		}); // $(function(){
		
    		

    </script>
@endsection












