 const formSearch = document.getElementById('formSearch')
        const inputSearch = document.getElementById('inputSearch')
        let viewBerita = document.getElementById('viewBerita')
        const loadSearch = document.getElementById('loadSearch')
        let alertError = document.getElementById('alertError')
        formSearch.addEventListener('submit', async (a) => {
            a.preventDefault()
            viewBerita.innerHTML = ''
            alertError.innerHTML = ''
            loadSearch.classList.remove('hidden')
            console.log(loadSearch)
            try {
                let res = await $.ajax({
                    url: `/search/berita/${inputSearch.value.trim()}`,
                    method: "GET",
                    xhrFields: {
                        withCredentials: true
                    },
                })
                console.log(res)
                res.data.forEach(function(item) {
                    viewBerita.innerHTML += ` <div
                        class="w-[90%] bg-white md:w-full mx-auto shadow-[-3px_0px_5px_rgba(0,0,0,.25),3px_0px_5px_rgba(0,0,0,.25),0px_5px_5px_rgba(0,0,0,.25)] rounded-lg p-3 grid gap-2">
                        <div class="flex gap-3">
                            <img src="${item.publisher_logo}" alt="logo_berita" class="w-12 h-12">
                            <div class="grid">
                                <h1 class="font-semibold text-black/80">
                                    ${item.source_name}
                                </h1>
                                <div class="flex items-center">
                                    <i class='bx bxs-calendar mr-1 self-start text-black/50'></i>
                                    <div class="font-normal text-base"> ${item.pubDate}</div>
                                </div>
                            </div>
                        </div>
                       <div class="h-40 grid">
                            <div>
                                <h1 class="font-semibold h-full text-xl">
                                    ${item.title}
                                </h1>
                            </div>
                            <div class="w-full bg-primary self-end  px-3 py-2 rounded-sm">
                                <a href="" class="w-fit mx-auto text-center" target="blank">
                                    <p class="text-light font-semibold">Selengkapnya</p>
                                </a>
                            </div>
                        </div>
                    </div>`
                })

            } catch (err) {
                alertError.innerHTML = `
                <div class="w-full md:h-screen">
                 <div class="w-[90%]  md:w-[65%] lg:w-[50%] xl:w-[35%] mx-auto bg-white rounded-lg shadow p-6 text-center grid gap-3">
                        <i class='bx bx-error-circle text-5xl text-primary'></i>
                        <h1 class="text-lg font-semibold text-black/70">
                            Berita tidak ditemukan
                        </h1>
                        <p class="text-sm text-black/50">
                            Tidak ada berita yang cocok dengan kata kunci:
                            <span class="font-semibold text-black/70">${inputSearch.value}</span>
                        </p>
                    </div> 
                    </div>` 
            } finally {
                loadSearch.classList.add('hidden')

            }
        })