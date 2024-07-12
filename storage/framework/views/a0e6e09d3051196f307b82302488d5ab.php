<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
	<!--begin::Menu wrapper-->
	<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
		<!--begin::Menu-->
		<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?php echo e(request()->routeIs('dashboard') ? 'here show' : ''); ?>">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon"><?php echo getIcon('element-11', 'fs-2'); ?></span>
					<span class="menu-title">Subscriptions</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('subscription') ? 'active' : ''); ?>" href="<?php echo e(route('subscription')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Subscribe</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?php echo e(request()->routeIs('dashboard') ? 'here show' : ''); ?>">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon"><?php echo getIcon('element-11', 'fs-2'); ?></span>
					<span class="menu-title">Dashboards</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Default</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('scraper.index') ? 'active' : ''); ?>" href="<?php echo e(route('scraper.index')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Scrape Query</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('scraper.history') ? 'active' : ''); ?>" href="<?php echo e(route('scraper.history')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Scrape History</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('scraper.history.favourites') ? 'active' : ''); ?>" href="<?php echo e(route('scraper.history.favourites')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Favourites</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('scraper.scheduler') ? 'active' : ''); ?>" href="<?php echo e(route('scraper.scheduler')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Scrape Scheduler</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('scraper.show-schedule') ? 'active' : ''); ?>" href="<?php echo e(route('scraper.show-schedule')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Schedule</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Apps</span>
				</div>
				<!--end:Menu content-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?php echo e(request()->routeIs('user-management.*') ? 'here show' : ''); ?>">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon"><?php echo getIcon('abstract-28', 'fs-2'); ?></span>
					<span class="menu-title">User Management</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('user-management.users.*') ? 'active' : ''); ?>" href="<?php echo e(route('user-management.users.index')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Users</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('user-management.roles.*') ? 'active' : ''); ?>" href="<?php echo e(route('user-management.roles.index')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Roles</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('user-management.permissions.*') ? 'active' : ''); ?>" href="<?php echo e(route('user-management.permissions.index')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Permissions</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?php echo e(request()->routeIs('customers.*') ? 'here show' : ''); ?>">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon"><?php echo getIcon('abstract-38', 'fs-2'); ?></span>
					<span class="menu-title">Customers</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('customers.customers-list.*') ? 'active' : ''); ?>" href="<?php echo e(route('customers.customers-list.index')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Customer List</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('customers.customers-details.*') ? 'active' : ''); ?>" href="<?php echo e(route('customers.customers-details.index')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Customer Details</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?php echo e(request()->routeIs('tickets.*') ? 'here show' : ''); ?>">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon"><?php echo getIcon('abstract-48', 'fs-2'); ?></span>
					<span class="menu-title">Tickets</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('tickets.tickets-list.*') ? 'active' : ''); ?>" href="<?php echo e(route('tickets.tickets-list.index')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Tickets List</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link <?php echo e(request()->routeIs('tickets.submit-ticket.*') ? 'active' : ''); ?>" href="<?php echo e(route('tickets.submit-ticket.index')); ?>">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Submit Ticket</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Help</span>
				</div>
				<!--end:Menu content-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="https://preview.keenthemes.com/html/metronic/docs/base/utilities" target="_blank">
					<span class="menu-icon"><?php echo getIcon('rocket', 'fs-2'); ?></span>
					<span class="menu-title">Components</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="https://preview.keenthemes.com/laravel/metronic/docs" target="_blank">
					<span class="menu-icon"><?php echo getIcon('abstract-26', 'fs-2'); ?></span>
					<span class="menu-title">Documentation</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="https://preview.keenthemes.com/laravel/metronic/docs/changelog" target="_blank">
					<span class="menu-icon"><?php echo getIcon('code', 'fs-2'); ?></span>
					<span class="menu-title">Changelog v8.2.5</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
		</div>
		<!--end::Menu-->
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
<?php /**PATH /home/scanlolo/public_html/scproject.muthallath.com/resources/views/layout/partials/sidebar-layout/sidebar/_menu.blade.php ENDPATH**/ ?>