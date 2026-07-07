<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Antrian - Medika Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-10">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-blue-600 p-6 text-center text-white">
                <h1 class="text-2xl font-bold uppercase tracking-wide">Nomor Antrian Sekarang</h1>
            </div>
            
            <div class="p-10 text-center">
                <div id="current-number" class="text-9xl font-black text-blue-600 mb-4 transition-all duration-500">
                    --
                </div>
                <p class="text-gray-500 text-lg uppercase font-semibold">Silakan Menuju Loket</p>
            </div>

            <div class="bg-gray-50 p-6 border-t border-gray-100">
                <h2 class="text-lg font-bold text-gray-700 mb-4">Daftar Tunggu:</h2>
                <div id="waiting-list" class="flex flex-wrap gap-3">
    
                </div>
            </div>
        </div>

        <div class="text-center mt-6 text-gray-400 text-sm">
            &copy; Aplikasi Antrian Online
        </div>
    </div>

    <script>
        function updateQueue() {
            fetch('/api/queue-status')
                .then(response => response.json())
                .then(data => {

                    const currentEl = document.getElementById('current-number');
                    if(currentEl.innerText != data.current) {
                        currentEl.innerText = data.current;
        
                        currentEl.classList.add('scale-110');
                        setTimeout(() => currentEl.classList.remove('scale-110'), 300);
                    }

       
                    const listEl = document.getElementById('waiting-list');
                    let listHtml = '';
                    if (data.waiting.length > 0) {
                        data.waiting.forEach(item => {
                            listHtml += `<span class="bg-white border border-blue-200 px-4 py-2 rounded-full text-blue-600 font-bold shadow-sm">${item.queue_number}</span>`;
                        });
                    } else {
                        listHtml = '<span class="text-gray-400 italic text-sm">Tidak ada antrian menunggu</span>';
                    }
                    listEl.innerHTML = listHtml;
                })
                .catch(error => console.error('Error:', error));
        }

        setInterval(updateQueue, 3000);
        updateQueue();
    </script>
</body>
</html>