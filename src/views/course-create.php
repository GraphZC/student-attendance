<a 
    class="text-blue-500 mb-3 hover:underline"
    href="/courses"
>
    &#9668; ย้อนกลับ
</a>
<h1 class="text-2xl font-bold mb-3">
    สร้างคอร์สเรียน
</h1>        
<form
    action="/courses"
    method="post"
>   
    <div class="grid gap-4">
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700">ชื่อวิชา</label>
            <input 
                type="text" 
                id="subject" 
                name="subject" 
                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            >
        </div>
        <div>
            <label for="room-no" class="block text-sm font-medium text-gray-700">ห้องเรียน</label>
            <input 
                type="text" 
                id="room-no" 
                name="roomNo" 
                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            >
        </div>
        <div>
            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition block"
            >
                สร้างคอร์สเรียน
            </button>
        </div>
    </div>
</form>