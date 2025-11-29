// src/app/services/auth.service.ts
import { Injectable, inject } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { PLATFORM_ID } from '@angular/core';
import { isPlatformBrowser } from '@angular/common';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  // URL base de la API de Laravel
  private apiUrl = 'http://127.0.0.1:8000/api';

  private platformId = inject(PLATFORM_ID);
  private http = inject(HttpClient);

  constructor() {}

  // =============================
  //  PETICIONES DE AUTENTICACIÓN
  // =============================

  // Registra un nuevo usuario en el sistema
  register(data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/register`, data);
  }

  // Inicia sesión con email y contraseña
  login(email: string, password: string): Observable<any> {
    return this.http.post(`${this.apiUrl}/login`, { email, password });
  }

  // Obtiene el perfil del usuario autenticado
  profile(): Observable<any> {
    return this.http.get(`${this.apiUrl}/profile`, {
      headers: this.authHeaders(),
    });
  }

  // Cierra la sesión del usuario
  logout(): Observable<any> {
    // Elimina el reto diario al cerrar sesión
    localStorage.removeItem('retoDiario');

    return this.http.post(
      `${this.apiUrl}/logout`,
      {},
      {
        headers: this.authHeaders(),
      }
    );
  }

  // =============================
  //  ACTUALIZACIÓN DE PERFIL
  // =============================

  // Actualiza la información del perfil del usuario
  updateProfile(data: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/user/update`, data, {
      headers: this.authHeaders(),
    });
  }

  // =============================
  //  MANEJO DE TOKEN Y ALMACENAMIENTO
  // =============================

  // Verifica si está en un entorno de navegador (no SSR)
  private isBrowser(): boolean {
    return isPlatformBrowser(this.platformId);
  }

  // Crea los headers con el token de autenticación
  private authHeaders(): HttpHeaders {
    const token = this.getToken();

    return token
      ? new HttpHeaders({
          Authorization: `Bearer ${token}`,
          'Content-Type': 'application/json',
        })
      : new HttpHeaders({ 'Content-Type': 'application/json' });
  }

  // Obtiene el token JWT del almacenamiento local
  getToken(): string | null {
    if (!this.isBrowser()) return null;
    return localStorage.getItem('token');
  }

  // Obtiene los datos del usuario del almacenamiento local
  getUser(): any {
    if (!this.isBrowser()) return null;
    const u = localStorage.getItem('user');
    return u ? JSON.parse(u) : null;
  }

  // Guarda el token y datos del usuario en el almacenamiento local
  setSession(token: string, user: any): void {
    if (!this.isBrowser()) return;
    localStorage.setItem('token', token);
    localStorage.setItem('user', JSON.stringify(user));

    // Elimina el reto diario para generar uno nuevo en cada login
    localStorage.removeItem('retoDiario');
  }

  // Limpia toda la sesión del almacenamiento local
  clearSession(): void {
    if (!this.isBrowser()) return;
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    localStorage.removeItem('retoDiario');
  }

  // Verifica si el usuario está autenticado
  isLoggedIn(): boolean {
    return !!this.getToken();
  }
}
