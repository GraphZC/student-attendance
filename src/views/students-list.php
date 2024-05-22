<div>
    <a 
        class="text-blue-500 mb-3 hover:underline"
        href="/"
    >
        &#9668; ย้อนกลับ
    </a>

    <h2 class="text-xl font-bold mb-3">เพิ่มนักเรียน</h2>
    <form
        action="/students"
        method="post"
        class="my-4"
    >
        <div class="grid gap-4">
            <div>
                <label for="id" class="block text-sm font-medium text-gray-700">รหัสนักเรียน</label>
                <input 
                    type="text" 
                    id="id" 
                    name="id" 
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">ชื่อ</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
            </div>
            <div>
                <button 
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition block"
                >
                    <h2>เพิ่มนักเรียน</hh2>
                </button>
            </div>
        </div>
    </form>
    <?php if (empty($students)): ?>
        <p class="text-red-400"> ไม่มีนักเรียนในคอร์สนี้</p>
    <?php endif; ?>

    <h2 class="text-xl font-bold mb-3">นักเรียนทั้งหมด</h2>
    <table>
        <thead >
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2 px-6 text-sm font-bold">รหัสนักเรียน</th>
                <th class="border border-gray-300 p-2 px-6 text-sm font-bold">ชื่อ</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td class="border border-gray-300 p-2 px-6 text-sm"><?= $student->id ?></td>
                    <td class="border border-gray-300 p-2 px-6 text-sm"><?= $student->name ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>
