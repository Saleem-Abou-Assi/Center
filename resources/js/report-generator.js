// resources/js/report-generator.js
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import * as XLSX from 'xlsx';

class ReportGenerator {
    static async generateDailyReport(exportType) {
        try {
            const response = await fetch('/admin/reports/daily', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ export_type: exportType })
            });
            
            const data = await response.json();
            
            if (exportType === 'pdf') {
                this.generatePDF(data, 'daily');
            } else {
                this.generateExcel(data, 'daily');
            }
        } catch (error) {
            console.error('Error generating report:', error);
            alert('Error generating report. Please try again.');
        }
    }

    static async generateCustomReport(params) {
        try {
            if (params.report_type === 'all') {
                const combinedData = [];
                
                const deptResponse = await fetch('/admin/reports/custom', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({...params, report_type: 'patientDept'})
                });
                const deptData = await deptResponse.json();
                
                const lazerResponse = await fetch('/admin/reports/custom', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({...params, report_type: 'lazer'})
                });
                const lazerData = await lazerResponse.json();
                
                combinedData.push(...deptData, ...lazerData);
                
                if (params.export_type === 'pdf') {
                    this.generatePDF(combinedData, 'custom');
                } else {
                    this.generateExcel(combinedData, 'custom');
                }
            } else {
                const response = await fetch('/admin/reports/custom', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(params)
                });
                
                const data = await response.json();
                
                if (params.export_type === 'pdf') {
                    this.generatePDF(data, 'custom');
                } else {
                    this.generateExcel(data, 'custom');
                }
            }
        } catch (error) {
            console.error('Error generating report:', error);
            alert('Error generating report. Please try again.');
        }
    }

    static generatePDF(data, type) {
        const doc = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4',
            putOnlyUsedFonts: true
        });

        // Add Arabic font support
        doc.addFont('path/to/arabic-font.ttf', 'Arabic', 'normal');
        doc.setFont('Arabic');
        doc.setR2L(true); // Enable right-to-left for Arabic text

        // Add title
        doc.text(`${type.charAt(0).toUpperCase() + type.slice(1)} Report`, 14, 15);
        
        if (type === 'daily') {
            // Add patient department data
            if (data.patientDept && data.patientDept.length > 0) {
                doc.text('Patient Department', 14, 25);
                doc.autoTable({
                    startY: 30,
                    head: [['Patient Name', 'Department', 'Doctor', 'Date', 'Cost']],
                    body: data.patientDept.map(item => [
                        item.patient_name,
                        item.department_name,
                        item.doctor_name,
                        item.created_at,
                        item.total_cost
                    ])
                });
            }

            // Add lazer data
            if (data.lazer && data.lazer.length > 0) {
                const finalY = doc.lastAutoTable ? doc.lastAutoTable.finalY + 10 : 30;
                doc.text('Lazer Sessions', 14, finalY);
                doc.autoTable({
                    startY: finalY + 5,
                    head: [['Patient Name', 'Doctor', 'Date', 'Cost']],
                    body: data.lazer.map(item => [
                        item.patient_name,
                        item.doctor_name,
                        item.created_at,
                        item.cost
                    ])
                });
            }
        } else {
            // Custom report
            doc.autoTable({
                startY: 25,
                head: [['Patient Name', 'Type', 'Doctor', 'Date', 'Cost']],
                body: data.map(item => [
                    item.patient_name,
                    item.type || item.department_name,
                    item.doctor_name,
                    item.created_at,
                    item.cost || item.total_cost
                ]),
                styles: {
                    font: 'Arabic',
                    fontStyle: 'normal'
                }
            });
        }
        
        doc.save(`${type}-report.pdf`);
    }

    static generateExcel(data, type) {
        const wb = XLSX.utils.book_new();
        
        if (type === 'daily') {
            if (data.patientDept && data.patientDept.length > 0) {
                const patientWS = XLSX.utils.json_to_sheet(data.patientDept);
                XLSX.utils.book_append_sheet(wb, patientWS, "Patient Department");
            }
            
            if (data.lazer && data.lazer.length > 0) {
                const lazerWS = XLSX.utils.json_to_sheet(data.lazer);
                XLSX.utils.book_append_sheet(wb, lazerWS, "Lazer Sessions");
            }
        } else {
            const ws = XLSX.utils.json_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, "Report Data");
        }
        
        XLSX.writeFile(wb, `${type}-report.xlsx`);
    }
}

window.ReportGenerator = ReportGenerator;