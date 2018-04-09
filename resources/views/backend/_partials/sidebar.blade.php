<!--sidebar start-->
<? $url= Request::path();?>
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">

                <li>
                    <a class="visit_site" target="_blank" href="{{URL::to('/')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>visit site</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo($url=='dashboard')?'active' : '' ?>"  href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,12) =='published-ad')?'active' : '' ?>"  href="{{URL::to('/published-ad')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Published Post</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,9) =='manage-ad')?'active' : '' ?>"  href="{{URL::to('/manage-ad')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Pending Post</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,14) =='published-jobs')?'active' : '' ?>"  href="{{URL::to('/published-jobs')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Published Jobs</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,16) =='unpublished-jobs')?'active' : '' ?>"  href="{{URL::to('/unpublished-jobs')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Pending Jobs</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,15) =='manage-business')?'active' : '' ?>"  href="{{URL::to('/manage-business')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Published Business Profile</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,16) =='pending-business')?'active' : '' ?>"  href="{{URL::to('/pending-business')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Pending Business Profile</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,12) =='manage-eshop')?'active' : '' ?>"  href="{{URL::to('/manage-eshop')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Eshop</span>
                    </a>
                </li>
                
                <li>
                    <a class="<? echo(substr($url,0,4) =='menu')?'active' : '' ?>"  href="{{URL::to('/menu')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Menu Configuration</span>
                    </a>
                </li>
                
                <li>
                    <a class="<? echo(substr($url,0,12)=='social-links')?'active' : '' ?>"  href="{{URL::to('/social-links')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Social Links</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,5) =='pages')?'active' : '' ?>"  href="{{URL::to('/pages')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Page</span>
                    </a>
                </li>
               <li class="sub-menu">
                    <a class="<? echo(substr($url,0,8)=='category' or substr($url,0,17)=='business-category') ? 'active' : '' ?>" href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub">
                        <li class="<? echo(substr($url,0,8)=='category') ? 'active' : '' ?>"><a href="{{URL::to('category')}}">Product Category</a></li>
                        <li class="<? echo(substr($url,0,17)=='business-category') ? 'active' : '' ?>"><a href="{{URL::to('business-category')}}">Business Category</a></li>
                    </ul>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,5)=='brand')?'active' : '' ?>"  href="{{URL::to('/brand')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Brand</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,10)=='post-field')?'active' : '' ?>"  href="{{URL::to('/post-field')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Post Field</span>
                    </a>
                </li>
                      <li>
                    <a class="<? echo(substr($url,0,10)=='manage-faq')?'active' : '' ?>"  href="{{URL::to('/manage-faq')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Manage-FAQ</span>
                    </a>
                </li>
                <li>
                    <a class="<? echo(substr($url,0,10)=='banner-manager')?'active' : '' ?>"  href="{{URL::to('/banner-manager')}}">
                        <i class="fa fa-folder-o"></i>
                        <span>Ad Manager</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="<? echo(substr($url,0,5)=='other') ? 'active' : '' ?>" href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span>Others</span>
                    </a>
                    <ul class="sub">
                        <li class="<? echo($url=='others-info/primary/edit') ? 'active' : '' ?>"><a href="{{URL::to('others-info/primary/edit')}}">Primary Info</a></li>
                        <li class="<? echo($url=='other/about') ? 'active' : '' ?>"><a href="{{URL::to('other/about')}}">About</a></li>
                        <li class="<? echo($url=='division-town') ? 'active' : '' ?>"><a href="{{URL::to('division-town')}}">Division/Town</a></li>
                    </ul>
                </li>
                <li>
                    <a class="<? echo($url=='users')?'active' : '' ?>"  href="{{URL::to('/users')}}">
                        <i class="fa fa-users"></i>
                        <span>Users Panel</span>
                    </a>
                </li>
                
            </ul>
            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
