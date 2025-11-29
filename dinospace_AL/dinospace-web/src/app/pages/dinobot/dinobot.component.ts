import { Component, ElementRef, ViewChild, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ChatService } from '../../services/chat.service';

// Define la estructura de un mensaje del chat
interface ChatMessage {
  type: 'bot' | 'user';
  text: string;
  time: string;
  options?: string[];
}

@Component({
  selector: 'app-dinobot',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './dinobot.component.html',
  styleUrls: ['./dinobot.component.css'],
})
export class DinobotComponent implements OnInit {
  // Referencia al contenedor de mensajes para hacer scroll
  @ViewChild('messageContainer') messageContainer!: ElementRef;

  // Almacena todos los mensajes de la conversación
  messages: ChatMessage[] = [];

  // ID de sesión para mantener la conversación
  private sessionId: string | null = null;

  // Controla si está cargando una respuesta
  isLoading: boolean = false;

  // Controla si mostrar el botón inicial
  showInitialButton: boolean = true;

  constructor(private chatService: ChatService) {}

  ngOnInit() {
    // Intenta cargar el session_id desde el almacenamiento local
    const savedSessionId = localStorage.getItem('dinobot_session_id');

    if (savedSessionId) {
      this.sessionId = savedSessionId;
      this.loadConversationHistory(savedSessionId);
    }
  }

  // Carga el historial de conversación desde el servidor
  private loadConversationHistory(sessionId: string) {
    this.isLoading = true;

    this.chatService.getConversationHistory(sessionId).subscribe({
      next: (response) => {
        if (response.messages && response.messages.length > 0) {
          // Oculta el botón inicial si hay mensajes
          this.showInitialButton = false;

          // Convierte los mensajes del servidor al formato local
          this.messages = response.messages.map((msg: any) => ({
            type: msg.type,
            text: msg.text,
            time: msg.time,
            options: msg.type === 'bot' && msg.options ? msg.options : [],
          }));

          // Limpia las opciones de mensajes antiguos del bot
          this.cleanOldBotOptions();
          this.scrollToBottom();
        }
        this.isLoading = false;
      },
      error: (error) => {
        // Si hay error, inicia una nueva conversación
        localStorage.removeItem('dinobot_session_id');
        this.sessionId = null;
        this.showInitialButton = true;
        this.isLoading = false;
      },
    });
  }

  // Limpia las opciones de mensajes antiguos del bot, manteniendo solo las del último mensaje
  private cleanOldBotOptions() {
    // Encuentra el último mensaje del bot
    for (let i = this.messages.length - 1; i >= 0; i--) {
      if (this.messages[i].type === 'bot') {
        // Limpia opciones de todos los mensajes del bot excepto este último
        for (let j = 0; j < i; j++) {
          if (this.messages[j].type === 'bot') {
            this.messages[j].options = [];
          }
        }
        break;
      }
    }
  }

  // Inicia una nueva conversación cuando el usuario hace clic en "Hola"
  startConversation() {
    this.showInitialButton = false;
    this.isLoading = true;

    this.chatService.sendMessage('init', this.sessionId || undefined).subscribe({
      next: (res) => {
        // Guarda el session_id en el almacenamiento local
        if (res.session_id) {
          this.sessionId = res.session_id;
          localStorage.setItem('dinobot_session_id', res.session_id);
        }

        // Agrega el mensaje del bot con las opciones
        this.addBotMessage(res.reply, res.suggestions || []);
        this.isLoading = false;
      },
      error: (error) => {
        // Mensaje de fallback en caso de error
        this.addBotMessage('¡Hola! Soy DinoBot ¿Cómo te sientes hoy?', [
          'Triste',
          'Ansioso/a',
          'Tranquilo/a',
          'No estoy seguro/a',
        ]);
        this.isLoading = false;
      },
    });
  }

  // Maneja cuando el usuario selecciona una opción del bot
  selectOption(option: string) {
    if (this.isLoading) return;

    // Limpia todas las opciones de mensajes anteriores del bot
    this.messages.forEach((msg) => {
      if (msg.type === 'bot' && msg.options) {
        msg.options = [];
      }
    });

    // Muestra la respuesta natural del usuario
    const userDisplayMessage = this.getUserDisplayMessage(option);
    this.addUserMessage(userDisplayMessage);

    this.isLoading = true;

    // Envía la opción seleccionada al servidor
    this.chatService.sendMessage(option, this.sessionId || undefined).subscribe({
      next: (res) => {
        // Actualiza el session_id si viene en la respuesta
        if (res.session_id) {
          this.sessionId = res.session_id;
          localStorage.setItem('dinobot_session_id', res.session_id);
        }

        // Agrega la respuesta del bot con nuevas opciones
        this.addBotMessage(res.reply, res.suggestions || []);
        this.isLoading = false;
      },
      error: (error) => {
        // Mensaje de error en caso de fallo
        this.addBotMessage('Error de conexión. Intenta nuevamente.', ['Reintentar']);
        this.isLoading = false;
      },
    });
  }

  // Convierte las opciones del bot en respuestas naturales del usuario
  private getUserDisplayMessage(option: string): string {
    const naturalResponses: { [key: string]: string } = {
      Triste: 'Me siento triste hoy',
      'Ansioso/a': 'Estoy sintiendo ansiedad',
      'Tranquilo/a': 'Me siento tranquilo/a',
      'No estoy seguro/a': 'No estoy seguro de cómo me siento',
      'Canción suave': 'Me gustaría escuchar una canción suave',
      'Recomendación de libro': 'Quiero una recomendación de libro',
      'Ejercicio de respiración': 'Quiero hacer un ejercicio de respiración',
      'Técnica rápida de calma': 'Necesito una técnica de calma',
      'Música relajante': 'Pon música relajante',
      'Mini-relajación guiada': 'Guíame en una relajación',
      'Frase positiva': 'Dame una frase positiva',
      'Música suave': 'Música suave por favor',
      'Actividad tranquila': 'Sugiere una actividad tranquila',
      'Explorar emociones': 'Ayúdame a explorar mis emociones',
      'Frase de claridad': 'Dame una frase de claridad',
      'Respiración suave': 'Enséñame a respirar suave',
      'Sí, tengo otra inquietud': 'Sí, tengo otra inquietud',
      'No, gracias': 'No, gracias',
      'Iniciar nueva conversación': 'Quiero iniciar nueva conversación',
      Reintentar: 'Reintentar',
    };

    return naturalResponses[option] || option;
  }

  // Agrega un mensaje del usuario al chat
  addUserMessage(text: string) {
    this.messages.push({
      type: 'user',
      text,
      time: this.getTime(),
    });
    this.scrollToBottom();
  }

  // Agrega un mensaje del bot al chat
  addBotMessage(text: string, options: string[] = []) {
    this.messages.push({
      type: 'bot',
      text,
      options,
      time: this.getTime(),
    });
    this.scrollToBottom();
  }

  // Obtiene la hora actual formateada
  getTime(): string {
    const d = new Date();
    return `${String(d.getHours()).padStart(2, '0')}:${String(d.getMinutes()).padStart(2, '0')}`;
  }

  // Hace scroll al final del contenedor de mensajes
  scrollToBottom() {
    setTimeout(() => {
      if (this.messageContainer?.nativeElement) {
        this.messageContainer.nativeElement.scrollTop =
          this.messageContainer.nativeElement.scrollHeight;
      }
    }, 150);
  }

  // Limpia toda la conversación y reinicia el chat
  clearChat() {
    // Limpia el almacenamiento local
    localStorage.removeItem('dinobot_session_id');

    this.messages = [];
    this.sessionId = null;
    this.isLoading = false;
    this.showInitialButton = true;
  }
}
