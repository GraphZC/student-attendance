<div>
    <button 
        class="text-blue-500 mb-3 hover:underline"
        onclick="window.history.back()"
    >
        &#9668; ย้อนกลับ
    </button>
    <div class="flex justify-between content-center">
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
        <div class="my-auto flex gap-2">
            <a 
                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition block"
                href="/courses/<?= $course->id ?>/students"
            >
                <h2>นักเรียน</h2>
            </a>
            <a 
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition block"
                href="/courses/<?= $course->id ?>/attendance-sheets/create"
            >
                <h2>สร้างแบบฟอร์มเช็คชื่อ</h2>
            </a>
        </div>
    </div>
       
    <div id="attendance-sheet-list" class="grid gap-3">
        <?php foreach ($attendanceSheets as $attendanceSheet): ?>
            <a 
                class="bg-white px-4 py-2 rounded-lg  border-[1.5px] border-gray-200 hover:border-gray-400 transition"
                href="/attendance-sheets/<?= $attendanceSheet->id ?>"
            >
                <h2>เดือน <?= $attendanceSheet->getMonthTh() ?></h2>
                <h2>ปี พ.ศ. <?= $attendanceSheet->year ?></h2>
            </a>
        <?php endforeach; ?>
    </div>
</div>
