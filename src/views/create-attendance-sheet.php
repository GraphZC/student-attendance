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
    <form
        action="/attendance-sheets"
        method="post"
    >
        <div class="grid gap-4">
            <input 
                type="hidden" 
                name="courseId" 
                value="<?= $course->id ?>"
            >
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">ปี พ.ศ.</label>
                <select 
                    id="year" 
                    name="year" 
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                    <?php
                        $thisYear = (int)date('Y') + 543;
                        for ($i = $thisYear; $i <= $thisYear + 5; $i++):
                    ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div>
                <label for="month" class="block text-sm font-medium text-gray-700">เดือน</label>
                <select 
                    id="month" 
                    name="month" 
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                    <?php
                        $months = [
                            1 => 'มกราคม',
                            2 => 'กุมภาพันธ์',
                            3 => 'มีนาคม',
                            4 => 'เมษายน',
                            5 => 'พฤษภาคม',
                            6 => 'มิถุนายน',
                            7 => 'กรกฎาคม',
                            8 => 'สิงหาคม',
                            9 => 'กันยายน',
                            10 => 'ตุลาคม',
                            11 => 'พฤศจิกายน',
                            12 => 'ธันวาคม'
                        ];
                        foreach ($months as $key => $month):
                    ?>
                        <option value="<?= $key ?>"><?= $month ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button 
            type="submit" 
            class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            สร้าง
        </button>
    </form>
</div>