import { Routes } from '@angular/router';
import { LoginComponent } from './screen/login/login.component';
import { EmployeeListComponent } from './screen/auth/employee-list/employee-list.component';
import { EmployeeAddComponent } from './screen/auth/employee-add/employee-add.component';
import { EmployeeEditComponent } from './screen/auth/employee-edit/employee-edit.component';
import { AuthGuard } from './guards/auth.guard';

export const routes: Routes = [
  { path: 'login', component: LoginComponent },
  {
    path: 'employees',
    canActivate: [AuthGuard],
    children: [
      { path: '', component: EmployeeListComponent },
      { path: 'add', component: EmployeeAddComponent },
      { path: 'edit/:id', component: EmployeeEditComponent },
    ],
  },
  { path: '**', redirectTo: 'login' },
];