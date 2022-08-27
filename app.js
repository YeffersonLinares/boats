    createApp({
        data() {
            return {
                count: 0,
                message: 'Hello Vue!',
                table: {horas_array: [], reservas: []},
                filter: {date: ''},
                days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                // days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                days_english: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                botes: [],
                today: new Date(),
                cant_days_month: 0,
                first_day: '',
                position: 9999,
                show_day: -1,
                calendar: [],
                calendar_vue: [[], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [],[],[],[]],
                day_vue: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],
                dia_num: 0
            },
        },
        mounted() {
            console.log('entro a home.html');
            this.getResults()
            console.log('created')
            this.getBarcos()
            this.startMonth()
        },
        methods: {
            getResults() {
                console.log('date ==> ', this.filter.date)
                let url = 'https://rutaapp.com/boats/wp-content/themes/twentytwentytwo/logica.php'
                url += '?date='+this.filter.date
                axios.get(url).then(res => {
                    this.table.horas_array = res.data.horas_array
                    this.table.reservas = res.data.reservas
                })
            },

            dia(){
                if(this.dia_num == 31) this.dia_num = 0
                this.dia_num++
                return this.dia_num
            },
            async getBarcos() {
                let url = 'https://rutaapp.com/boats/wp-content/themes/twentytwentytwo/ReservaController.php'
                await axios.get(url).then(res => {
                    console.log('barcos ==> ', res.data)
                    this.botes = res.data.botes
                    this.calendar = res.data.calendar
                    this.map_calendar()
                })
            },
            daysByMont(mes, anio) {
                return new Date(anio, mes, 0).getDate();
            },
            startMonth(){
                let year = this.today.getFullYear()
                let month = this.today.getMonth() + 1
                this.first_day = new Date(this.today.getFullYear() + '-' + (parseInt(this.today.getMonth()) + 1) + '-' + '1').toDateString().substring(0,3)
                this.days_english.forEach((ele, index) => {
                    if(ele == this.first_day) {
                        this.position = index
                    }
                });

                this.cant_days_month = this.daysByMont(month, year)
            },
            start_day(){
                console.log('entro ');
                this.show_day++
                if(this.show_day >= this.position) {
                    return true
                }else {
                    return false
                }
            },
            map_calendar(){
                let days = []
                for (let index = 0; index < this.cant_days_month; index++) days.push(index+1)
                days.forEach((ele, index) => {
                    console.log('%c entro a foreach', 'color:red;');
                    let date = new Date()
                    let month = date.getMonth() + 1
                    if(month < 10) month = '0' + month
                    date = date.getFullYear() + '-' + month + '-' + ele
                    this.calendar.forEach((row) => {
                        if(date == row.fecha) this.calendar_vue[index].push(row)
                    });
                })
                let semana1 = this.calendar_vue.splice(1,7)
                let semana2 = this.calendar_vue.splice(1,7)
                let semana3 = this.calendar_vue.splice(1,7)
                let semana4 = this.calendar_vue.splice(1,7)
                let semana5 = this.calendar_vue.splice(1,3)
                this.calendar_vue = [semana1, semana2, semana3, semana4, semana5]
            },
            funct(){
                console.log('entro a esta pagina')
            }
        },
    }).mount('#app')