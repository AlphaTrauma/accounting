@extends('layouts.dashboard')

@section('content')
    <h1>Список зарегистрированных пользователей</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-full">
        <div class=" space-y-4 pb-4 bg-white">
            <form class="relative p-3 flex gap-5">
                
                <div class="flex gap-3">
                    <input type="text" id="table-search-users" name="query" value="{{ request('query') }}" class="tw-input" placeholder="Поиск по имени и email">
                    <button type="submit" class="btn btn-sm btn-active"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <table class="w-full text-sm text-left  text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Имя
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Роль
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Статус
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                        @if($user->image)
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                        @endif
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ $user->name }}</div>
                            <div class="font-normal text-gray-500">{{ $user->email }}</div>
                        </div>  
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            @if($user->admin)<b>Администратор </b>@endif
                            @if($user->customer)<b>Заказчик</b>@endif
                            @if($user->executor)<b>Исполнитель</b>@endif
                        </div>
                        
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($user->session and $user->session->last_activity)
                                @if((time() - $user->session->last_activity) <= 600)
                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Онлайн
                                @else
                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Был {{ date('d.m.Y H:i', $user->session->last_activity) }}
                                @endif
                            @else 
                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Оффлайн
                            @endif
                            
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if(!$user->admin)
                       <form method="POST" class="flex justify-end" action="{{ route('users.addRole') }}">
                           @csrf
                           <input type="hidden" name="role" value="admin">
                           <input type="hidden" name="user_id" value="{{ $user->id }}">
                           <input type="submit" class="btn btn-sm btn-primary" value="Сделать админом">
                       </form>
                       @endif
                    </td>
                </tr>
                @empty
                    <tr>
                        <th scope="row" colspan="4" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                            Нет зарегистрированных пользователей
                        </th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    

    <div class="py-5">
        {{ $users->links() }}
    </div>
@endsection