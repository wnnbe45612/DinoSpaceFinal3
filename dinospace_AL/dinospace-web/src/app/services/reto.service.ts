// src/app/services/reto.service.ts
import { Injectable, inject } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, catchError, throwError } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class RetoService {
  private http = inject(HttpClient);
  private apiUrl = 'http://127.0.0.1:8000/api';

  // Obtiene un reto diario personalizado desde el servidor
  obtenerRetoDiario(): Observable<any> {
    // Obtiene el token JWT del almacenamiento local
    const token = localStorage.getItem('token');

    console.log('Token en reto service:', token ? 'PRESENTE' : 'AUSENTE');

    // Crea los headers con el token de autorización si está disponible
    const headers = new HttpHeaders({
      ...(token && { Authorization: `Bearer ${token}` }),
      'Content-Type': 'application/json',
      Accept: 'application/json',
    });

    // Realiza la petición GET al endpoint de retos diarios
    return this.http.get(`${this.apiUrl}/reto-diario`, { headers }).pipe(
      catchError((error) => {
        console.log('Error en reto service:', error.status);
        // Maneja errores de autenticación (401)
        if (error.status === 401) {
          return throwError(() => new Error('Unauthorized - usando reto por defecto'));
        }
        return throwError(() => error);
      })
    );
  }
}
