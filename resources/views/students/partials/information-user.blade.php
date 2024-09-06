
<div class="myAccount-profile">
    <div class="row align-items-center">
        <div class="col-lg-4 col-md-5">
            <div class="profile-image  text-center">
                <img src="{{ $user->profile_photo_url }}" alt="image">
            </div>
        </div>

        <div class="col-lg-7 col-md-7">
            <div class="profile-content">
                <h3>{{ $user->name }} {{ $user->last_name }}</h3>
                <h4><span>Matrícula: </span>{{ $user->matricula }}</h4>

                <ul class="contact-info">
                    <li><i class="bx bx-envelope"></i> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                    <li><i class="bx bx-phone"></i> <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></li>
                </ul>
                <ul class="contact-info">
                    <li><span>Plantel: </span> {{ $user->plantel->name ?? 'N/A' }}</li>
                    <li><span>Nivel Educativo: </span> {{ $user->educationLevel->name ?? 'N/A' }}</li>
                    <li><span>Grado: </span> {{ $user->grade->name ?? 'N/A' }}</li>
                    <li><span>Grupo: </span> {{ $user->group->name ?? 'N/A' }}</li>
                </ul>

                <div class="contact_box_info d-flex flex-column pt-3">
                    <div>
                        <a href="{{ route('student.edit') }}" class="myAccount-edit">Editar Información</a>
                    </div>
                    <div> 
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="myAccount-logout" href="#"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class='bx bx-log-out'></i> Cerrar sesión
                            </a>
                        </form>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
