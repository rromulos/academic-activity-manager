<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('university') }}'><i class="las la-university"></i> {{ trans('backpack::crud.Universities') }} </a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('student') }}'><i class="las la-user-graduate"></i> {{ trans('backpack::crud.Students') }} </a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('subject') }}'><i class="las la-book"></i> {{ trans('backpack::crud.Subjects') }} </a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('activity') }}'><i class="las la-tasks"></i></i> {{ trans('backpack::crud.Activities') }} </a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('charge') }}'><i class="las la-file-invoice-dollar"></i> {{ trans('backpack::crud.Charges') }} </a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('payment') }}'><i class="las la-money-bill"></i> {{ trans('backpack::crud.Payments') }} </a></li>
