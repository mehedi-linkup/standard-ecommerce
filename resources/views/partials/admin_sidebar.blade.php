<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            @php
                $prefix = Request::route()->getPrefix();
                $route = Route::current()->getName();
                @endphp
            <div class="nav">
                {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
                <a class="nav-link  {{($route == 'admin.index')?'active':''}}" href="{{ route('admin.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @php
                    $permisson = \App\Models\Permission::with('page')->where('user_id',Auth::id())->get();
                 @endphp
                @foreach ($permisson as $p)
                    @if($p->page->name == 'order.index')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'order.index')?'active':''}}"  href="{{route('order.index')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-spinner"></i></div>
                            Pending Order
                            </a> 
                        @endif
                    @endif
                    
                    
                    @if($p->page->name == 'order.onProcess')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'order.onProcess')?'active':''}}" href="{{route('order.onProcess')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-project-diagram"></i></div>
                            On Processing Order
                        </a> 
                        @endif
                    @endif
                    @if($p->page->name == 'order.way')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'order.way')?'active':''}}" href="{{route('order.way')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-road"></i></div>
                            On The way
                        </a> 
                        @endif
                    @endif
                    @if($p->page->name == 'share.sale.list')
                    @if($p->page->status == 1)
                    <a class="nav-link {{($route == 'share.sale.list')?'active':''}}" href="{{route('share.sale.list')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-road"></i></div>
                      Share Sale List
                    </a> 
                    @endif
                @endif
                    {{-- @if($p->page->name == 'waiting.delivered.normal')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'waiting.delivered.normal')?'active':''}}" href="{{route('waiting.delivered.normal')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-circle-notch"></i></div>
                           Normal Order Waiting Delivary
                        </a> 
                        @endif
                    @endif --}}
                    @if($p->page->name == 'order.normal.delivary')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'order.normal.delivary')?'active':''}}" href="{{route('order.normal.delivary')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck-loading"></i></div>
                           Product  Delivary
                        </a> 
                        @endif
                    @endif
                    @if($p->page->name == 'order.offer.pending')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'order.offer.pending')?'active':''}}"  href="{{route('order.offer.pending')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-spinner"></i></div>
                           Offer Pending
                            </a> 
                        @endif
                    @endif
                    @if($p->page->name == 'offer.onProcess')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'offer.onProcess')?'active':''}}" href="{{route('offer.onProcess')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-project-diagram"></i></div>
                            Offer On Processing Order
                        </a> 
                        @endif
                    @endif
                    @if($p->page->name == 'offer.way')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'offer.way')?'active':''}}" href="{{route('offer.way')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-road"></i></div>
                            Offer On The way
                        </a> 
                        @endif
                    @endif
                    @if($p->page->name == 'waiting.delivered')
                    @if($p->page->status == 1)
                    <a class="nav-link {{($route == 'waiting.delivered')?'active':''}}" href="{{route('waiting.delivered')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-road"></i></div>
                        Waiting Delivared
                    </a> 
                    @endif
                     @endif
                     @if ($p->page->name == 'share.delivery.list')
                     @if($p->page->status == 1)
                     <a class="nav-link {{($route == 'share.delivery.list')?'active':''}}" href="{{route('share.delivery.list')}}">
                         <div class="sb-nav-link-icon"><i class="fas fa-truck-loading"></i></div>
                         Offer Delivered
                     </a> 
                     @endif
                  @endif

                    @if ($p->page->name == 'order.delivary')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'order.delivary')?'active':''}}" href="{{route('order.delivary')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck-loading"></i></div>
                            Delivered Order
                        </a> 
                        @endif
                    @endif
                    @if ($p->page->name == 'cancel.list')
                    @if($p->page->status == 1)
                    <a class="nav-link {{($route == 'cancel.list')?'active':''}}" href="{{route('cancel.list')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-truck-loading"></i></div>
                        Order Cancel List
                    </a> 
                    @endif
                @endif

                    @if ($p->page->name == 'sales.report')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'sales.report')?'active':''}}" href="{{route('sales.report')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-balance-scale-left"></i></div>
                            Sales Report
                        </a> 
                        @endif
                    @endif
                    @if ($p->page->name == 'order.record')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'order.record')?'active':''}}" href="{{route('order.record')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-balance-scale-left"></i></div>
                            Order Record
                        </a> 
                        @endif
                    @endif
                    @if ($p->page->name == 'customer-delete.invoice')
                        @if($p->page->status == 1)
                        <a class="nav-link {{($route == 'customer-delete.invoice')?'active':''}}" href="{{route('customer-delete.invoice')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-balance-scale-left"></i></div>
                            Customer delete invoice
                        </a> 
                        @endif
                    @endif
                @endforeach
                    <a class="nav-link {{($prefix == 'product')?'':'collapsed'}}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="{{($prefix == 'product')?'true':'false'}}" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-window-restore"></i></div>
                            Product Info
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                <div class="collapse {{($prefix == 'product')?'collapse show':''}}" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        @foreach ($permisson as $p)
                            @if ($p->page->name == 'product.create')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'product.create')?'active':''}}" href="{{ route('product.create') }}"><i class="fas fa-angle-right"></i>&nbsp;Product Entry</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'product.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'product.index')?'active':''}}"  href="{{ route('product.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Product List</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'category.index')
                                @if($p->page->status == 1)
                                <a class="nav-link {{($route == 'category.index')?'active':''}}"  href="{{ route('category.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Category Entry</a> 
                                @endif
                            @endif
                            @if ($p->page->name == 'category.list')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'category.list')?'active':''}}" href="{{ route('category.list') }}"><i class="fas fa-angle-right"></i>&nbsp;Category List</a>
                                @endif
                            @endif
                                @if ($p->page->name == 'category.rank')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'category.rank')?'active':''}}" href="{{ route('category.rank') }}"><i class="fas fa-angle-right"></i>&nbsp;Category Rank</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'subcategory.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'subcategory.index')?'active':''}}" href="{{ route('subcategory.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Sub Category Entry</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'subcategory.list')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'subcategory.list')?'active':''}}" href="{{ route('subcategory.list') }}"><i class="fas fa-angle-right"></i>&nbsp;Sub Category List</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'color.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'color.index')?'active':''}}" href="{{ route('color.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Color </a>
                                @endif
                            @endif
                            @if ($p->page->name == 'size.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'size.index')?'active':''}}" href="{{ route('size.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Size</a>
                                @endif
                            @endif
                        @endforeach
                       
                        {{-- <a class="nav-link {{($route == 'color.index')?'active':''}}" href="{{ route('color.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Color</a>
                        <a class="nav-link {{($route == 'size.index')?'active':''}}" href="{{ route('size.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Size</a> --}}
                    </nav>
                </div>
                    <a class="nav-link {{($prefix == 'customer')?'':'collapsed'}}" href="{{ route('customer') }}" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                            Customer
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                <div class="collapse {{($prefix == 'customer')?'collapse show':''}}" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @foreach ($permisson as $p)
                            @if ($p->page->name == 'customer')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'customer')?'active':''}}" href="{{ route('customer') }}"><i class="fas fa-angle-right"></i>&nbsp;Customer Entry</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'customer.pending')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'customer.pending')?'active':''}}" href="{{ route('customer.pending') }}"><i class="fas fa-angle-right"></i>&nbsp;Pending Customer</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'customer.list')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'customer.list')?'active':''}}" href="{{ route('customer.list') }}"><i class="fas fa-angle-right"></i>&nbsp;Customer List</a>
                                @endif
                            @endif
                        @endforeach
                    </nav>
                </div>
                <a class="nav-link {{($prefix == 'website-content')?'':'collapsed'}}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Website Contents
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{($prefix == 'website-content')?'collapse show':''}} " id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @foreach ($permisson as $p)
                            @if ($p->page->name == 'welcome')
                                @if($p->page->status == 1)
                                <a class="nav-link {{($route == 'welcome')?'active':''}}" href="{{ route('welcome') }}"><i class="fas fa-angle-right"></i>&nbsp;Welcome Note</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'company.banner')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'company.banner')?'active':''}}" href="{{ route('company.banner') }}"><i class="fas fa-angle-right"></i>&nbsp;Slider Entry</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'photo-gallery.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'photo-gallery.index')?'active':''}}" href="{{ route('photo-gallery.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Photo Gallery</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'video.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'video.index')?'active':''}}" href="{{ route('video.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Video Gallery</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'service.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'service.index')?'active':''}}" href="{{ route('service.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Services Entry</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'about.us')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'about.us')?'active':''}}" href="{{ route('about.us') }}"><i class="fas fa-angle-right"></i>&nbsp;About Us Page</a>
                                @endif
                            @endif 
                            @if ($p->page->name == 'mission')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'mission')?'active':''}}" href="{{ route('mission') }}"><i class="fas fa-angle-right"></i>&nbsp;Mission-Vission</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'managment.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'managment.index')?'active':''}}" href="{{ route('management.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Management Page</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'team.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'team.index')?'active':''}}" href="{{ route('team.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Our Team Page</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'faq')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'faq')?'active':''}}" href="{{ route('faq') }}"><i class="fas fa-angle-right"></i>&nbsp;FAQ Page</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'refund')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'refund')?'active':''}}" href="{{ route('refund') }}"><i class="fas fa-angle-right"></i>&nbsp;Refund Policy</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'ad.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'ad.index')?'active':''}}" href="{{ route('ad.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Ad Management</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'management.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'management.index')?'active':''}}"  href="{{ route('management.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Management</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'partner.index')
                                @if($p->page->status == 1)
                                <a class="nav-link {{($route == 'partner.index')?'active':''}}" href="{{ route('partner.index') }}"><i class="fas fa-angle-right"></i>&nbsp; Partner</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'blog.index')
                                @if($p->page->status == 1)
                                <a class="nav-link {{($route == 'blog.index')?'active':''}}" href="{{ route('blog.index') }}"><i class="fas fa-angle-right"></i>&nbsp;News and Event</a>
                                @endif
                            @endif
                        @endforeach
                        
                    </nav>
                </div>
                
                @foreach ($permisson as $p)
                    @if ($p->page->name == 'public.sms')
                        @if($p->page->status == 1)
                            <a class="nav-link {{($route == 'public.sms')?'active':''}}  " href="{{route('public.sms')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-sms"></i></div>
                                Public Message 
                            </a>
                        @endif
                    @endif
                    @if ($p->page->name == 'subscriber.list')
                        @if($p->page->status == 1)
                            <a class="nav-link {{($route == 'subscriber.list')?'active':''}} " href="{{route('subscriber.list')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-id-card-alt"></i></div>
                                Subscriber List
                            </a>
                         @endif
                    @endif
                @endforeach
                <a class="nav-link {{($prefix == 'setting')?'':'collapsed'}}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-sliders-h"></i></div>
                    Settings
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                
                <div class="collapse {{($prefix == 'setting')?'collapse show':''}} " id="collapseLayouts4" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @foreach ($permisson as $p)
                            @if ($p->page->name == 'profile.edit')
                                @if($p->page->status == 1)
                                <a class="nav-link {{($route == 'profile.edit')?'active':''}}" href="{{ route('profile.edit') }}"><i class="fas fa-angle-right"></i>&nbsp;company profile</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'sms.sending')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'sms.sending')?'active':''}}" href="{{ route('sms.sending') }}"><i class="fas fa-angle-right"></i>&nbsp;SMS Sending</a>
                                @endif
                            @endif
                                @if ($p->page->name == 'admin.phone.edit')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'admin.phone.edit')?'active':''}}" href="{{ route('admin.phone.edit') }}"><i class="fas fa-angle-right"></i>&nbsp;Admin Phone Edit</a>
                                @endif
                             @endif
                            @if ($p->page->name == 'page.list')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'page.list')?'active':''}}" href="{{ route('page.list') }}"><i class="fas fa-angle-right"></i>&nbsp;Page List</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'area.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'area.index')?'active':''}}" href="{{ route('area.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Area Entry</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'thana.index')
                            @if($p->page->status == 1)
                                <a class="nav-link {{($route == 'thana.index')?'active':''}}" href="{{ route('thana.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Thana Entry</a>
                            @endif
                            @endif
                            @if ($p->page->name == 'country.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'country.index')?'active':''}}" style="white-space: nowrap" href="{{route('country.index')}}"><i class="fas fa-angle-right"></i>&nbsp;Country Management</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'user.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'user.index')?'active':''}}"  href="{{ route('user.index') }}"><i class="fas fa-angle-right"></i>&nbsp;User Create</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'permission.index')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'permission.index')?'active':''}}"  href="{{ route('permission.index') }}"><i class="fas fa-angle-right"></i>&nbsp;Permission</a>
                                @endif
                            @endif
                             @if ($p->page->name == 'customer.offer')
                                @if($p->page->status == 1)
                                    <a class="nav-link {{($route == 'customer.offer')?'active':''}}"  href="{{ route('customer.offer') }}"><i class="fas fa-angle-right"></i>&nbsp;Offer Settings</a>
                                @endif
                            @endif
                            @if ($p->page->name == 'user.phone.edit')
                            @if($p->page->status == 1)
                                <a class="nav-link {{($route == 'user.phone.edit')?'active':''}}"  href="{{ route('user.phone.edit') }}"><i class="fas fa-angle-right"></i>&nbsp;User Phone Settings</a>
                            @endif
                        @endif
                            
                        @endforeach
                        <a class="nav-link {{($route == 'set-time')?'active':''}}" href="{{ route('set-time') }}"><i class="fas fa-angle-right"></i>&nbsp; Time Set</a>
                       
                    </nav>
                </div>
                <a class="nav-link" href="{{ route('logout') }}" onclick="return confirm('Are you sure logout from Admin Panel')">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                    Log Out
                </a>
            </div>
        </div>
    </nav>
</div>