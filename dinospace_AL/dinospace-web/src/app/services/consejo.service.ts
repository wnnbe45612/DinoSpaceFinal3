// src/app/services/consejo.service.ts
import { Injectable, inject } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root',
})
export class ConsejoService {
  // URL del endpoint para obtener consejos del día
  private url = 'http://localhost:8000/api/consejo-del-dia';

  private http = inject(HttpClient);
  private authService = inject(AuthService);

  constructor() {}

  // Obtiene un consejo aleatorio del servidor
  obtenerConsejo() {
    return this.http.get(this.url, {
      headers: this.authHeaders(),
    });
  }

  // Crea los headers de autorización con el token JWT
  private authHeaders(): HttpHeaders {
    const token = this.authService.getToken();

    return token
      ? new HttpHeaders({
          Authorization: `Bearer ${token}`,
          'Content-Type': 'application/json',
        })
      : new HttpHeaders({ 'Content-Type': 'application/json' });
  }
}
