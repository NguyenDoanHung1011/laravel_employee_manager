import { Component, inject } from '@angular/core';
import { EmployeeService } from './../../../services/employee.service';
import { Router } from '@angular/router';
import { MaterialModule } from '../../../material.module';

@Component({
  selector: 'app-employee-add',
  standalone: true,
  imports: [MaterialModule],
  templateUrl: './employee-add.component.html',
  styleUrls: ['./employee-add.component.scss'],
})
export class EmployeeAddComponent {
  private employeeService = inject(EmployeeService);
  private router = inject(Router);

  addEmployee(employee: any) {
    this.employeeService.createEmployee(employee).subscribe(() => this.router.navigate(['/employees']));
  }
}
