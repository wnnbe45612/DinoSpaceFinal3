import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { RouterModule } from '@angular/router';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../services/auth.service';
import { HttpClientModule } from '@angular/common/http';

@Component({
  standalone: true,
  selector: 'app-register',
  imports: [FormsModule, RouterModule, CommonModule, HttpClientModule],
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
})
export class RegisterComponent {
  // Controla el paso actual del formulario (de 1 a 8)
  step = 1;

  // Almacena todos los datos del formulario de registro
  formData = {
    nombre: '',
    edad: null as number | null,
    genero: '',
    correo: '',
    ciclo: '',
    estadoEmocional: '',
    horasSueno: '',
    actividad: '',
    motivacion: '',
    password: '',
    confirmarPassword: '',
  };

  // Almacena mensajes de error para cada campo
  errors: any = {};

  constructor(private router: Router, private authService: AuthService) {}

  // Calcula el porcentaje de progreso basado en el paso actual
  get progressPercentage(): number {
    return (this.step / 8) * 100;
  }

  // --- VALIDACIONES DE CAMPOS ---

  // Solo permite ingresar letras en el campo de nombre
  onlyLetters(event: KeyboardEvent) {
    const char = event.key;
    if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]$/.test(char)) {
      event.preventDefault();
    }
  }

  // Valida que al pegar texto solo sean letras
  onPaste(event: ClipboardEvent) {
    const pasted = event.clipboardData?.getData('text') || '';
    if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/.test(pasted)) {
      event.preventDefault();
    }
  }

  // Limpia el error de un campo cuando el usuario comienza a escribir
  onFieldChange(field: string) {
    if (this.errors[field]) delete this.errors[field];
  }

  // Valida que la edad esté entre 17 y 65 años
  validateAge(): boolean {
    this.errors.edad = '';

    if (
      this.formData.edad === null ||
      this.formData.edad === undefined ||
      this.formData.edad === 0
    ) {
      this.errors.edad = 'La edad es obligatoria';
      return false;
    }

    const edad = Number(this.formData.edad);

    if (isNaN(edad)) {
      this.errors.edad = 'Debes ingresar un número válido';
      return false;
    } else if (edad < 17 || edad > 65) {
      this.errors.edad = 'La edad debe estar entre 17 y 65 años';
      return false;
    }

    return true;
  }

  // Valida el formato del correo electrónico
  validateEmail(): boolean {
    this.errors.correo = '';
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!this.formData.correo.trim()) {
      this.errors.correo = 'El correo es obligatorio';
      return false;
    } else if (!pattern.test(this.formData.correo)) {
      this.errors.correo = 'Ingresa un correo válido';
      return false;
    }

    return true;
  }

  // Valida que la contraseña tenga al menos 6 caracteres
  validatePassword(): boolean {
    this.errors.password = '';

    if (!this.formData.password) {
      this.errors.password = 'La contraseña es obligatoria';
      return false;
    } else if (this.formData.password.length < 6) {
      this.errors.password = 'La contraseña debe tener al menos 6 caracteres';
      return false;
    }

    return true;
  }

  // Valida que las contraseñas coincidan
  validateConfirmPassword(): boolean {
    this.errors.confirmarPassword = '';

    if (!this.formData.confirmarPassword) {
      this.errors.confirmarPassword = 'Debes confirmar la contraseña';
      return false;
    } else if (this.formData.password !== this.formData.confirmarPassword) {
      this.errors.confirmarPassword = 'Las contraseñas no coinciden';
      return false;
    }

    return true;
  }

  // --- NAVEGACIÓN ENTRE PASOS DEL FORMULARIO ---

  // Avanza al siguiente paso si la validación es exitosa
  nextStep(): void {
    if (this.validateCurrentStep()) {
      this.step++;
    }
  }

  // Regresa al paso anterior
  prevStep(): void {
    if (this.step > 1) this.step--;
  }

  // Regresa a la página de inicio
  goToHome(): void {
    this.router.navigate(['/']);
  }

  // Valida todos los campos del paso actual
  validateCurrentStep(): boolean {
    this.errors = {};
    let isValid = true;

    switch (this.step) {
      case 1:
        if (!this.formData.nombre.trim()) {
          this.errors.nombre = 'El nombre es obligatorio';
          isValid = false;
        }
        if (!this.validateAge()) {
          isValid = false;
        }
        if (!this.formData.genero) {
          this.errors.genero = 'Selecciona un género';
          isValid = false;
        }
        break;

      case 2:
        if (!this.validateEmail()) {
          isValid = false;
        }
        break;

      case 3:
        if (!this.formData.ciclo) {
          this.errors.ciclo = 'Selecciona tu ciclo';
          isValid = false;
        }
        break;

      case 4:
        if (!this.formData.estadoEmocional) {
          this.errors.estadoEmocional = 'Selecciona cómo te sientes';
          isValid = false;
        }
        break;

      case 5:
        if (!this.formData.horasSueno) {
          this.errors.horasSueno = 'Selecciona tus horas de sueño';
          isValid = false;
        }
        break;

      case 6:
        if (!this.formData.actividad) {
          this.errors.actividad = 'Selecciona una opción';
          isValid = false;
        }
        break;

      case 7:
        if (!this.formData.motivacion) {
          this.errors.motivacion = 'Selecciona el tipo de motivación';
          isValid = false;
        }
        break;

      case 8:
        if (!this.validatePassword()) {
          isValid = false;
        }
        if (!this.validateConfirmPassword()) {
          isValid = false;
        }
        break;
    }

    return isValid;
  }

  // --- ENVÍA EL FORMULARIO COMPLETO AL SERVIDOR ---
  submitForm(): void {
    if (this.validateCurrentStep()) {
      const dataToSend = {
        nombre: this.formData.nombre,
        edad: this.formData.edad,
        genero: this.formData.genero,
        correo: this.formData.correo, // El AuthController espera 'correo' para registro
        ciclo: this.formData.ciclo,
        estadoEmocional: this.formData.estadoEmocional,
        horasSueno: this.formData.horasSueno,
        actividad: this.formData.actividad,
        motivacion: this.formData.motivacion,
        password: this.formData.password,
      };

      // Llama al servicio de registro
      this.authService.register(dataToSend).subscribe({
        next: (resp: any) => {
          // Guarda el token y datos del usuario en el almacenamiento local
          localStorage.setItem('token', resp.token);
          localStorage.setItem('user', JSON.stringify(resp.user));

          alert('¡Registro exitoso! Bienvenido a DinoSpace');
          this.router.navigate(['/dashboard']);
        },
        error: (error: any) => {
          console.error('Error en el registro:', error);

          // Maneja errores de validación del servidor
          if (error.error?.errors) {
            this.errors = error.error.errors;
          } else {
            alert('Error en el servidor. Intenta nuevamente.');
          }
        },
      });
    }
  }
}
