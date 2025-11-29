import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { RouterModule } from '@angular/router';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../services/auth.service';

@Component({
  standalone: true,
  selector: 'app-login',
  imports: [FormsModule, RouterModule, CommonModule],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent {
  // Almacena el email ingresado por el usuario
  email: string = '';

  // Almacena la contraseña ingresada por el usuario
  password: string = '';

  // Almacena mensajes de error para mostrar al usuario
  errorMessage: string = '';

  // Controla si está en proceso de login
  isLoading: boolean = false;

  constructor(private router: Router, private authService: AuthService) {}

  // Maneja el proceso de inicio de sesión
  login() {
    // Verifica que ambos campos estén completos
    if (!this.email.trim() || !this.password.trim()) {
      this.errorMessage = 'Por favor, completa todos los campos';
      return;
    }

    this.isLoading = true;
    this.errorMessage = '';

    // Llama al servicio de autenticación
    this.authService.login(this.email, this.password).subscribe({
      next: (resp: any) => {
        this.isLoading = false;

        // Verifica que la respuesta tenga token y datos de usuario
        if (resp.token && resp.user) {
          // Guarda el token y datos del usuario en el almacenamiento local
          localStorage.setItem('token', resp.token);
          localStorage.setItem('user', JSON.stringify(resp.user));

          console.log('Login exitoso:', resp.user);
          // Redirige al dashboard después del login exitoso
          this.router.navigate(['/dashboard']);
        } else {
          this.errorMessage = 'Respuesta inválida del servidor';
        }
      },
      error: (error: any) => {
        this.isLoading = false;
        console.error('Error en el login:', error);

        // Maneja diferentes tipos de errores del servidor
        if (error.status === 401) {
          this.errorMessage = 'Credenciales incorrectas. Verifica tu email y contraseña.';
        } else if (error.status === 404) {
          this.errorMessage = 'Usuario no encontrado.';
        } else if (error.status === 422) {
          // Maneja errores de validación de Laravel
          if (error.error.errors) {
            const firstError = Object.values(error.error.errors)[0];
            this.errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
          } else {
            this.errorMessage = error.error.message || 'Error de validación';
          }
        } else if (error.error?.message) {
          this.errorMessage = error.error.message;
        } else if (error.status === 0) {
          this.errorMessage = 'No se puede conectar al servidor. Verifica tu conexión.';
        } else {
          this.errorMessage = 'Error del servidor. Intenta nuevamente.';
        }
      },
    });
  }

  // Navega de regreso a la página de inicio
  goToHome(): void {
    this.router.navigate(['/']);
  }

  // Limpia los mensajes de error cuando el usuario comienza a escribir
  onInputChange() {
    if (this.errorMessage) {
      this.errorMessage = '';
    }
  }
}
