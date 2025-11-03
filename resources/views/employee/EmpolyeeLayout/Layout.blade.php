@extends('admin.AdminLayout.layout')

@section('sidebar')
<div class="sidebar">
  <h4>Employee Panel</h4>
  <a href="{{ route('employee.dashboard') }}" class="{{ request()->is('employee') ? 'active' : '' }}">🏠 Dashboard</a>
  <a href="{{ route('employee.reports.index') }}" class="{{ request()->is('employee/reports*') ? 'active' : '' }}">📊 Reports</a>
  <a href="{{ route('employee.tasks.index') }}" class="{{ request()->is('employee/tasks*') ? 'active' : '' }}">🧾 Tasks</a>
  <a href="{{ route('employee.profile') }}" class="{{ request()->is('employee/profile*') ? 'active' : '' }}">👤 Profile</a>
  <a href="{{ route('logout') }}" 
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
     class="mt-auto">🚪 Logout</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>
@endsection
