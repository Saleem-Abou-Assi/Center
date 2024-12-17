// Import required libraries
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import * as XLSX from 'xlsx';

class ReportGenerator {
    static async generateDailyReport(exportType) {
        try {
            const response = await fetch('/api/reports/daily');
            const data = await response.json();
            
            if (exportType === 'pdf') {
                this.generateDailyPDF(data);
            } else {
                this.generateDailyExcel(data);
            }
        } catch (error) {
            console.error('Error generating report:', error);
        }
    }

    static async generateCustomReport(params) {
        try {
            const response = await fetch('/api/reports/custom', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(params)
            });
            const data = await response.json();
            
            if (params.export_type === 'pdf') {
                this.generateCustomPDF(data);
            } else {
                this.generateCustomExcel(data);
            }
        } catch (error) {
            console.error('Error generating report:', error);
        }
    }

    static generateDailyPDF(data) {
        const doc = new jsPDF();
        
        // Add title
        doc.text('Daily Report', 14, 15);
        
        // Add patient department data
        doc.text('Patient Department', 14, 25);
        doc.autoTable({
            startY: 30,
            head: [['Patient Name', 'Department', 'Doctor', 'Date', 'Cost']],
            body: data.patientDept.map(item => [
                item.patient_name,
                item.department_name,
                item.doctor_name,
                item.visit_date,
                item.total_cost
            ])
        });
        
        // Add lazer session data
        const finalY = doc.lastAutoTable.finalY || 30;
        doc.text('Lazer Sessions', 14, finalY + 10);
        doc.autoTable({
            startY: finalY + 15,
            head: [['Patient Name', 'Session Type', 'Doctor', 'Date', 'Cost']],
            body: data.lazer.map(item => [
                item.patient_name,
                item.session_type,
                item.doctor_name,
                item.session_date,
                item.cost
            ])
        });
        
        doc.save('daily-report.pdf');
    }

    static generateCustomPDF(data) {
        const doc = new jsPDF();
        
        // Add title and summary
        doc.text('Custom Report', 14, 15);
        doc.text(`Period: ${data.summary.start_date} to ${data.summary.end_date}`, 14, 25);
        doc.text(`Total Patients: ${data.summary.total_patients}`, 14, 35);
        doc.text(`Total Revenue: ${data.summary.total_revenue}`, 14, 45);
        
        // Add main data
        doc.autoTable({
            startY: 55,
            head: [['Patient Name', 'Type', 'Doctor', 'Date', 'Cost']],
            body: data.data.map(item => [
                item.patient_name,
                data.summary.report_type === 'patientDept' ? item.department_name : item.session_type,
                item.doctor_name,
                data.summary.report_type === 'patientDept' ? item.visit_date : item.session_date,
                data.summary.report_type === 'patientDept' ? item.total_cost : item.cost
            ])
        });
        
        doc.save('custom-report.pdf');
    }

    static generateDailyExcel(data) {
        const wb = XLSX.utils.book_new();
        
        // Create patient department worksheet
        const patientWS = XLSX.utils.json_to_sheet(data.patientDept);
        XLSX.utils.book_append_sheet(wb, patientWS, "Patient Department");
        
        // Create lazer sessions worksheet
        const lazerWS = XLSX.utils.json_to_sheet(data.lazer);
        XLSX.utils.book_append_sheet(wb, lazerWS, "Lazer Sessions");
        
        XLSX.writeFile(wb, "daily-report.xlsx");
    }

    static generateCustomExcel(data) {
        const wb = XLSX.utils.book_new();
        
        // Create main data worksheet
        const ws = XLSX.utils.json_to_sheet(data.data);
        XLSX.utils.book_append_sheet(wb, ws, "Report Data");
        
        // Create summary worksheet
        const summaryWS = XLSX.utils.json_to_sheet([data.summary]);
        XLSX.utils.book_append_sheet(wb, summaryWS, "Summary");
        
        XLSX.writeFile(wb, "custom-report.xlsx");
    }
}

export default ReportGenerator;
