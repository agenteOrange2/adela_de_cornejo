<div class="myAccount-profile">
    <div class="row align-items-center">
        <div class="col-lg-4 col-md-5">
            <div class="profile-image">
                <img src="{{ $user->profile_photo_url }}" alt="image">
            </div>
        </div>

        <div class="col-lg-8 col-md-7">
            <div class="profile-content">
                <h3>{{ $user->name }} {{ $user->last_name }}</h3>
                <p>Matrícula: {{ $user->matricula }}</p>

                <ul class="contact-info">
                    <li><i class="bx bx-envelope"></i> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                    <li><i class="bx bx-phone"></i> <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></li>
                </ul>
                <ul class="contact-info">
                    <li>Plantel: {{ $user->plantel->name ?? 'N/A' }}</li>
                    <li>Nivel Educativo: {{ $user->educationLevel->name ?? 'N/A' }}</li>
                    <li>Grado: {{ $user->grade->name ?? 'N/A' }}</li>
                    <li>Grupo: {{ $user->group->name ?? 'N/A' }}</li>
                </ul>

                <a href="{{ route('student.edit') }}" class="myAccount-edit">Editar Información</a>
                <a href="{{ route('logout') }}" class="myAccount-logout">Logout</a>
            </div>
        </div>
    </div>
</div>
