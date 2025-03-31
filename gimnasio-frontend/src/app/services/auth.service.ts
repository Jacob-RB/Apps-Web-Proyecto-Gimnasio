import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { environment } from '../../environments/environment';
import { Observable, tap } from 'rxjs';

interface LoginResponse {
  token: string;
  user?: any;
}

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient, private router: Router) {}

  login(email: string, password: string): Observable<LoginResponse> {
    return this.http.post<LoginResponse>(`${this.apiUrl}/login`, { email, password })
      .pipe(
        tap(response => {
          if (response.token) {
            localStorage.setItem('auth_token', response.token);
          }
        })
      );
  }

  logout() {
    // Primero intentamos hacer logout en el servidor
    this.http.post(`${this.apiUrl}/logout`, {}).subscribe({
      complete: () => {
        localStorage.removeItem('auth_token');
        this.router.navigate(['/login']);
      },
      error: () => {
        // Si hay error, al menos limpiamos localmente
        localStorage.removeItem('auth_token');
        this.router.navigate(['/login']);
      }
    });
  }

  isLoggedIn(): boolean {
    return !!localStorage.getItem('auth_token');
  }

  getToken(): string | null {
    return localStorage.getItem('auth_token');
  }
} 