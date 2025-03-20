import { Component, inject, signal } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { EmployeeService } from './../../../services/employee.service';
import { MaterialModule } from '../../../material.module';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-employee-edit',
  standalone: true,
  imports: [MaterialModule, FormsModule],
  templateUrl: './employee-edit.component.html',
  styleUrls: ['./employee-edit.component.scss'],
})
export class EmployeeEditComponent {
  private employeeService = inject(EmployeeService);
  private route = inject(ActivatedRoute);
  private router = inject(Router);
  employee = signal<any>({});

  constructor() {
    const id = this.route.snapshot.params['id'];
    this.employeeService.getEmployees().subscribe((data) => {
      this.employee.set(data.find((e: any) => e.id == id));
    });
  }

  updateEmployee() {
    this.employeeService.updateEmployee(this.employee().id, this.employee()).subscribe(() => {
      this.router.navigate(['/employees']);
    });
  }
}
