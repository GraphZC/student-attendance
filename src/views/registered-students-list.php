<div>
    <button 
        class="text-blue-500 mb-3 hover:underline"
        onclick="window.history.back()"
    >
        &#9668; ย้อนกลับ
    </button>
    
    <div>
        <h1 
            class="text-2xl font-bold"
            id="subject"
        >
           วิชา <?= $course->subject ?>
        </h1> 
        <h3 
            class="text-lg mb-3"
            id="room-no"
        >
            ห้อง <?= $course->roomNo ?>
        </h3>
    </div>  

    <h2 class="text-xl font-bold mb-3">เพิ่มนักเรียน</h2>
    <div class="grid gap-4">
        <input 
            type="hidden" 
            name="courseId" 
            value="<?= $course->id ?>"
        >
        <div>
            <label for="id" class="block text-sm font-medium text-gray-700">ค้นหารหัสนักเรียน</label>
            <input 
                type="text" 
                id="searchId" 
                name="id" 
                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                onkeyup="handleSearchStudent()"
            >
        </div>
        <div id="search-result">

        </div>
    </div>
    <?php if (empty($students)): ?>
        <p class="text-red-400"> ไม่มีนักเรียนในคอร์สนี้</p>
    <?php endif; ?>

    <h2 class="text-xl font-bold mb-3">นักเรียนในคอร์ส</h2>
    <table>
        <thead>
            <tr>
                <th class="border border-gray-300 p-2 text-sm font-medium">รหัสนักเรียน</th>
                <th class="border border-gray-300 p-2 text-sm font-medium">ชื่อ</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td class="border border-gray-300 p-2 text-sm"><?= $student->id ?></td>
                    <td class="border border-gray-300 p-2 text-sm"><?= $student->name ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>

<script type="text/javascript">
    const courseId = <?= $course->id ?>;

    const fetchCreateRegister = async (id) => {
        const response = await fetch(`/api/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                studentId: id,
                courseId: courseId
            })
        });
        const student = await response.json();

        window.location.reload();
    }

    const fetchSearchStudents = async (id) => {
        const response = await fetch(`/api/students/search?id=${id}`);
        const students = await response.json();
        return students;
    }

    const renderSearchResult = (students) => {
        const searchResult = document.getElementById('search-result');
        searchResult.innerHTML = '';

        if (students.length === 0) {
            searchResult.innerHTML = '<p class="text-red-400">ไม่พบนักเรียน</p>';
            return;
        }
        students.forEach(student => {
            const studentDiv = document.createElement('div');
            studentDiv.classList.add('mb-2');
            studentDiv.innerHTML = `
                <div>   
                    <button
                        onclick="fetchCreateRegister(${student.id})"
                        class="bg-green-500 text-sm text-white py-1 px-2 rounded-lg hover:bg-green-600 transition"
                    >
                        +&nbspเพิ่ม
                    </button> 
                    <span>${student.id} - ${student.name}</span>
                </div>
            `;
            searchResult.appendChild(studentDiv);
        });
    } 

    const handleSearchStudent = async () => {
        const searchId = document.getElementById('searchId').value;
        const students = await fetchSearchStudents(searchId);
        renderSearchResult(students);
    }
</script>