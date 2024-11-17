{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Apps" icon="la la-question" :link="backpack_url('app')" />
<x-backpack::menu-item title="App monthly quotas" icon="la la-question" :link="backpack_url('app-monthly-quota')" />
<x-backpack::menu-item title="Blogs" icon="la la-question" :link="backpack_url('blog')" />
<x-backpack::menu-item title="Current user subscriptions" icon="la la-question" :link="backpack_url('current-user-subscription')" />
<x-backpack::menu-item title="Devices" icon="la la-question" :link="backpack_url('device')" />
<x-backpack::menu-item title="Device last locations" icon="la la-question" :link="backpack_url('device-last-location')" />
<x-backpack::menu-item title="Device locations" icon="la la-question" :link="backpack_url('device-location')" />
<x-backpack::menu-item title="Device monthly quotas" icon="la la-question" :link="backpack_url('device-monthly-quota')" />
<x-backpack::menu-item title="Device types" icon="la la-question" :link="backpack_url('device-type')" />
<x-backpack::menu-item title="Feedback" icon="la la-question" :link="backpack_url('feedback')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="User current quotas" icon="la la-question" :link="backpack_url('user-current-quota')" />
<x-backpack::menu-item title="User monthly quotas" icon="la la-question" :link="backpack_url('user-monthly-quota')" />