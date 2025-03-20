import { Component, inject, signal } from '@angular/core';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';
import { MaterialModule } from '../../material.module';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [MaterialModule],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent {
  private authService = inject(AuthService);
  private router = inject(Router);
  errorMessage = signal<string | null>(null);

  login(credentials: { email: string; password: string }) {
    this.authService.login(credentials).subscribe({
      next: (res) => {
        this.authService.setToken(res.token);
        this.router.navigate(['/employees']);
      },
      error: () => {
        this.errorMessage.set('Sai thông tin đăng nhập!');
      },
    });
  }
}
