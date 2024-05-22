<div>
    <button 
        class="text-blue-500 mb-3 hover:underline"
        onclick="window.history.back()"
    >
        &#9668; ย้อนกลับ
    </button>

    <h1 class="text-xl mb-2 font-bold" id="title">
        
    </h1>        
    <table>
        <thead id="table-date" class="text-center">
        </thead>
        <tbody id="attendance-sheet-list">

        </tbody>
    </table>
</div>

<script type="text/javascript">
    const tableDate = document.getElementById('table-date');
    
    const dayTh = ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"];

    const monthTh = [
        "มกราคม", 
        "กุมภาพันธ์", 
        "มีนาคม", 
        "เมษายน", 
        "พฤษภาคม", 
        "มิถุนายน", 
        "กรกฎาคม", 
        "สิงหาคม", 
        "กันยายน", 
        "ตุลาคม", 
        "พฤศจิกายน", 
        "ธันวาคม"
    ];

    const id = <?= $id ?>;
    let attendanceSheet = null;

    const createThElement = (content) => {
        const th = document.createElement('th');
        th.classList.add('border', 'border-gray-300', 'p-2', 'text-sm', 'font-medium');

        th.innerHTML = content;
        return th;
    }

    const renderTable = (year, month) => {
        const firstdate = new Date(year, month - 1, 1);
        const lastDate = new Date(year, month, 0);

        renderDateHeader(firstdate, lastDate);
    }

    const renderDateHeader = (firstDate, lastDate) => {
        const tr = document.createElement('tr');
        const nameTh = createThElement('ชื่อ-สกุล');
        nameTh.classList.add('w-80');
        tr.appendChild(nameTh);
        tableDate.innerHTML = '';
        for (let i = 0; i < lastDate.getDate(); i++) {
            const content = `
                ${i + 1} <br/> 
                ${dayTh[(firstDate.getDay() + i) % 7]} <br>
                <button class='bg-blue-500 p-1 text-white rounded-lg' onclick="updatePresentAllStudentInDay(${i + 1}, 'PRESENT')">ทั้งหมด</button>`;
            const dateTh = createThElement(content);
            tr.appendChild(dateTh);
        }

        tableDate.appendChild(tr);
        render
    }

    const fetchOneAttendanceSheet = async (id) => {
        const response = await fetch(`/api/attendance-sheets/${id}`);
        const attendanceSheet = await response.json();
        return attendanceSheet;
    }

    const renderStudentList = (students, year, month) => {
        const attendanceSheetList = document.getElementById('attendance-sheet-list');
        const firstdate = new Date(year, month - 1, 1);

        const numberOfDayInMonth = new Date(year, month, 0).getDate();

        attendanceSheetList.innerHTML = students.map(student => {
            const status = Array(numberOfDayInMonth).fill('NONE');
            
            for (const [key, value] of Object.entries(student.attendances)) {
                status[key - 1] = value;
            }

            return `
                <tr>
                    <td class="border border-gray-300 p-2 text-sm font-medium">${student.name}</td>
                    ${Array(numberOfDayInMonth).fill().map((_, i) => `
                        <td class="border border-gray-300 p-2 text-sm font-medium">
                            <select
                                onchange="updateAttendance(${student.id}, ${i + 1}, this.value)"
                            >
                                <option value="NONE" ${status[i] === 'NONE' ? 'selected' : ''}>-</option>
                                <option value="PRESENT" ${status[i] === 'PRESENT' ? 'selected' : ''}>มา</option>
                                <option value="ABSENT" ${status[i] === 'ABSENT' ? 'selected' : ''}>ขาด</option>
                                <option value="LEAVE" ${status[i] === 'LEAVE' ? 'selected' : ''}>ลา</option>
                                <option value="SICK" ${status[i] === 'SICK' ? 'selected' : ''}>ป่วย</option>
                            </select>
                        </td>
                    `).join('')}
                </tr>
            `;
        }).join('');
    }

    const updateAttendance = async (studentId, date, status) => {
        const response = await fetch(`/api/attendances`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify([
                {
                    attendanceSheetId: attendanceSheet.id,
                    studentId: studentId,
                    date: date,
                    status: status
                }
            ])
        });
        const result = await response.json();
        return result;
    }

    const updatePresentAllStudentInDay = async (day, status) => {
        const response = await fetch(`/api/attendances`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(
                attendanceSheet.students.map(student => ({
                    attendanceSheetId: attendanceSheet.id,
                    studentId: student.id,
                    date: day,
                    status: status
                }))
            )
        });
        const result = await response.json();
        await render();
        return result;
    }

    const setTitle = (attendanceSheet) => {
        const title = document.getElementById('title');
        document.title = `เดือน ${monthTh[attendanceSheet.month - 1]} ปี พ.ศ. ${attendanceSheet.year}`;
        title.innerHTML = `เดือน ${monthTh[attendanceSheet.month - 1]} ปี พ.ศ. ${attendanceSheet.year}`;
    }
    
    const render = async () => {
        attendanceSheet = await fetchOneAttendanceSheet(id);

        renderTable(attendanceSheet.year, attendanceSheet.month);
        renderStudentList(attendanceSheet.students, attendanceSheet.year, attendanceSheet.month);
        setTitle(attendanceSheet);
    }

    render();
</script>