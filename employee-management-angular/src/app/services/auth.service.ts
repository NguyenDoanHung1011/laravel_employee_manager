import { Injectable, signal } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { JwtHelperService } from '@auth0/angular-jwt';

@Injectable({ providedIn: 'root' })
export class AuthService {
  private apiUrl = 'http://127.0.0.1:8000/api';
  private jwtHelper = new JwtHelperService();
  userRole = signal<string | null>(null);

  constructor(private http: HttpClient, private router: Router) {}

  login(credentials: any) {
    return this.http.post<{ token: string }>(`${this.apiUrl}/login`, credentials);
  }

  setToken(token: string) {
    localStorage.setItem('token', token);
    this.userRole.set(this.jwtHelper.decodeToken(token).role);
  }

  logout() {
    localStorage.removeItem('token');
    this.userRole.set(null);
    this.router.navigate(['/login']);
  }

  isAuthenticated(): boolean {
    const token = localStorage.getItem('token');
    return token ? !this.jwtHelper.isTokenExpired(token) : false;
  }
}
