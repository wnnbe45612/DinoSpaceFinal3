import { Component, OnInit, inject } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../services/auth.service';
import { RetoService } from '../../services/reto.service';
import { ConsejoService } from '../../services/consejo.service';

// Define la estructura de un reto diario
interface RetoDiario {
  titulo: string;
  descripcion: string;
  duracion: string;
  dificultad: string;
  categoria: string;
  id?: number;
}

// Define la estructura de un consejo
interface Consejo {
  id?: number;
  titulo: string;
  descripcion: string;
}

@Component({
  standalone: true,
  selector: 'app-dashboard-content',
  imports: [CommonModule, FormsModule],
  templateUrl: './dashboard-content.component.html',
  styleUrls: ['./dashboard-content.component.css', '../dashboard/dashboard.styles.css'],
})
export class DashboardContentComponent implements OnInit {
  // Inyecta los servicios necesarios
  private auth = inject(AuthService);
  private retoService = inject(RetoService);
  private consejoService = inject(ConsejoService);

  // Almacena los datos del usuario
  userData: any = null;

  // Controla si está en modo edición del perfil
  isEditing: boolean = false;

  // Almacena los datos del formulario de edición
  formData: any = {
    ciclo: '',
    estadoEmocional: '',
    horasSueno: '',
    actividad: '',
    motivacion: '',
    edad: '',
  };

  // Almacena el reto diario del usuario
  retoDiario: RetoDiario | null = null;

  // Controla si está cargando el reto
  cargandoReto: boolean = true;

  // Almacena el consejo del día
  consejoDelDia: Consejo | null = null;

  // Controla si está cargando el consejo
  cargandoConsejo: boolean = true;

  ngOnInit(): void {
    // Carga el perfil del usuario al iniciar el componente
    this.auth.profile().subscribe({
      next: (resp) => {
        this.userData = resp.user || resp;
        this.cargarRetoDiario();
        this.cargarConsejoDelDia();
      },
      error: (err) => console.error(err),
    });
  }

  // Carga el reto diario desde el servicio o del almacenamiento local
  cargarRetoDiario(): void {
    this.cargandoReto = true;

    // Verifica si hay un reto guardado para hoy
    const retoGuardado = localStorage.getItem('retoDiario');
    const hoy = new Date().toDateString();
    const ultimaFechaReto = localStorage.getItem('ultimaFechaReto');

    // Si ya hay un reto para hoy, lo usa en lugar de pedir uno nuevo
    if (retoGuardado && ultimaFechaReto === hoy) {
      this.retoDiario = JSON.parse(retoGuardado);
      this.cargandoReto = false;
      return;
    }

    // Si no hay reto para hoy, solicita uno nuevo al servicio
    this.retoService.obtenerRetoDiario().subscribe({
      next: (resp: any) => {
        if (resp.success && resp.reto) {
          this.retoDiario = resp.reto;
          // Guarda el nuevo reto en el almacenamiento local
          localStorage.setItem('retoDiario', JSON.stringify(resp.reto));
          localStorage.setItem('ultimaFechaReto', hoy);
        } else {
          this.retoDiario = null;
        }
        this.cargandoReto = false;
      },
      error: () => {
        this.retoDiario = null;
        this.cargandoReto = false;
      },
    });
  }

  // Carga el consejo del día desde el servicio
  cargarConsejoDelDia(): void {
    this.cargandoConsejo = true;

    this.consejoService.obtenerConsejo().subscribe({
      next: (resp: any) => {
        console.log('Respuesta del consejo:', resp); // Para debug
        if (resp && resp.consejo) {
          this.consejoDelDia = resp.consejo;
        } else if (resp && resp.titulo) {
          // Por si la respuesta viene directa
          this.consejoDelDia = resp;
        } else {
          console.warn('Estructura de respuesta inesperada:', resp);
          // Genera un consejo aleatorio si la respuesta no es la esperada
          this.consejoDelDia = this.generarConsejoAleatorio();
        }
        this.cargandoConsejo = false;
      },
      error: (error) => {
        console.error('Error al cargar consejo:', error);
        // Genera un consejo aleatorio si hay error
        this.consejoDelDia = this.generarConsejoAleatorio();
        this.cargandoConsejo = false;
      },
    });
  }

  // Genera un consejo aleatorio solo si el servicio falla
  generarConsejoAleatorio(): Consejo {
    const consejos: Consejo[] = [
      {
        titulo: 'Mantén el enfoque',
        descripcion: 'Respira hondo y avanza paso a paso hoy.',
      },
      {
        titulo: 'Pequeños logros',
        descripcion: 'Celebra cada pequeño progreso en tu día.',
      },
      {
        titulo: 'Descanso activo',
        descripcion: 'Tómate pausas cortas para mantener tu energía.',
      },
      {
        titulo: 'Hidratación',
        descripcion: 'No olvides beber agua durante tu jornada.',
      },
      {
        titulo: 'Postura corporal',
        descripcion: 'Cuida tu postura para evitar tensiones.',
      },
    ];

    const indiceAleatorio = Math.floor(Math.random() * consejos.length);
    return consejos[indiceAleatorio];
  }

  // Activa el modo edición del perfil
  editProfile() {
    this.isEditing = true;
    this.formData = {
      edad: this.userData.edad,
      ciclo: this.userData.ciclo,
      estadoEmocional: this.userData.estado_emocional,
      horasSueno: this.userData.horas_sueno,
      actividad: this.userData.actividad,
      motivacion: this.userData.motivacion,
    };
  }

  // Cancela la edición del perfil
  cancelEdit() {
    this.isEditing = false;
  }

  // Guarda los cambios del perfil
  saveProfile() {
    const payload = {
      edad: this.formData.edad,
      ciclo: this.formData.ciclo,
      estadoEmocional: this.formData.estadoEmocional,
      horasSueno: this.formData.horasSueno,
      actividad: this.formData.actividad,
      motivacion: this.formData.motivacion,
    };


    // Envía los datos actualizados al servicio
    this.auth.updateProfile(payload).subscribe({
      next: (resp) => {
        this.userData = resp.user;

        // Actualiza la sesión con los nuevos datos
        const token = this.auth.getToken();
        if (token) this.auth.setSession(token, resp.user);

        // Recarga el reto y consejo con la nueva información
        this.cargarRetoDiario();
        this.cargarConsejoDelDia();

        this.isEditing = false;
      },
      error: (err) => console.error('Error al actualizar perfil:', err),
    });
  }
}
