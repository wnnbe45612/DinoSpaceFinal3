import { Component, OnInit, HostListener } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Router, RouterModule } from '@angular/router';
import { AuthService } from '../../services/auth.service';

@Component({
  standalone: true,
  selector: 'app-dashboard',
  imports: [CommonModule, RouterModule],
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css'],
})
export class DashboardComponent implements OnInit {
  // Almacena los datos del usuario
  user: any = null;

  // Almacena un consejo para mostrar al usuario
  consejo: string = '';

  // Controla si el menú móvil está abierto o cerrado
  isMenuOpen: boolean = false;

  constructor(private authService: AuthService, private router: Router) {}

  ngOnInit() {
    // Verifica si el usuario está logueado al cargar el componente
    if (!this.authService.isLoggedIn()) {
      this.router.navigate(['/login']);
      return;
    }

    // Obtiene los datos del usuario desde el servicio de autenticación
    this.user = this.authService.getUser();
    console.log('Usuario en el Dashboard:', this.user);

    // Establece un consejo por defecto para mostrar al usuario
    this.consejo = 'Hoy es un buen día para aprender algo nuevo';
  }

  // Abre o cierra el menú móvil
  toggleMenu() {
    this.isMenuOpen = !this.isMenuOpen;
  }

  // Cierra el menú móvil
  closeMenu() {
    this.isMenuOpen = false;
  }

  // Cierra el menú cuando se hace clic fuera de él (solo en móviles)
  @HostListener('document:click', ['$event'])
  onDocumentClick(event: Event) {
    const target = event.target as HTMLElement;
    if (!target.closest('.navbar') && !target.closest('.menu-toggle')) {
      this.isMenuOpen = false;
    }
  }

  // Cierra la sesión del usuario
  logout() {
    // Elimina el reto diario del almacenamiento local
    localStorage.removeItem('retoDiario');

    // Llama al servicio para cerrar sesión en el backend
    this.authService.logout().subscribe({
      next: () => {
        // Limpia la sesión local y redirige al login
        this.authService.clearSession();
        this.router.navigate(['/login']);
      },
      error: (error) => {
        console.error('Error en logout:', error);
        // Aunque haya error, limpia la sesión local
        this.authService.clearSession();
        this.router.navigate(['/login']);
      },
    });
  }
}
