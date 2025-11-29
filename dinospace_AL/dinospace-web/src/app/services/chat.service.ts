import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

// Define la estructura de la respuesta del chat
export interface ChatResponse {
  reply: string;
  suggestions: string[];
  session_id: string;
  conversation_id: number;
}

@Injectable({
  providedIn: 'root',
})
export class ChatService {
  // URL base del endpoint del chat en la API de Laravel
  private apiUrl = 'http://127.0.0.1:8000/api/chat';

  constructor(private http: HttpClient) {}

  // 🔥 Método privado para obtener los headers con el token de autenticación
  private getAuthHeaders(): HttpHeaders {
    const token = localStorage.getItem('token'); // ✅ Cambiado de 'auth_token' a 'token'
    return new HttpHeaders({
      'Content-Type': 'application/json',
      Authorization: `Bearer ${token}`,
    });
  }

  // Envía un mensaje al chatbot y obtiene una respuesta
  sendMessage(message: string, sessionId?: string): Observable<ChatResponse> {
    return this.http.post<ChatResponse>(
      `${this.apiUrl}/send`,
      {
        message,
        session_id: sessionId,
      },
      { headers: this.getAuthHeaders() } // 🔥 Incluye el token en cada petición
    );
  }

  // Obtiene el historial de conversación para una sesión específica
  getConversationHistory(sessionId: string): Observable<any> {
    return this.http.get(
      `${this.apiUrl}/history/${sessionId}`,
      { headers: this.getAuthHeaders() } // 🔥 Incluye el token en cada petición
    );
  }
}
