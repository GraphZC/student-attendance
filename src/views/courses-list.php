<a 
    class="text-blue-500 mb-3 hover:underline"
    href="/"
>
    &#9668; ย้อนกลับ
</a>
<div>
    <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-3">
            คอร์สเรียนทั้งหมด
        </h1>        
        <div class="my-auto">
            <a 
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition block"
                href="/courses/create"
            >
                <h2>สร้างคอร์สเรียน</h2>
            </a>
        </div>
    </div>
    <div class="grid grid-cols-5 gap-4" id="course-list">
        <?php foreach ($courses as $course): ?>
            <a 
                class="bg-white p-4 rounded-lg  border-[1.5px] border-gray-200 hover:border-gray-400 transition"
                href="/courses/<?= $course->id ?>"
            >
                <h2 class="text-xl font-bold"><?= $course->subject ?></h2>
                <p><?= $course->roomNo ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div