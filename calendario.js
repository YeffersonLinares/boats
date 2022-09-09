function calendario() {
    return {
                days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                days_english: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                botes: [],
                countDay:0,
                today: new Date(),
                cant_days_month: 0,
                first_day: '',
                position: 9999,
                // show_day: -1,
                calendar: [],
                calendar_vue: [],
                day_vue: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35],
                dia_num: 0,
                filtros: {vote_id: ""},
                show_day: 0,
                current_month: new Date().getMonth() + 1,
                current_year: new Date().getFullYear(),
                months: ['Diciembre','Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre', 'Enero'],
            init(){
                this.getBarcos()
                this.startMonth()
            },
            async getBarcos() {
                alert('0')
                // let url = 'https://rutaapp.com/boats/wp-content/themes/twentytwentytwo/ReservaController.php'
                console.log('this.current_month aa ==> ', this.current_month);
                let url = 'https://rutaapp.com/boats/wp-content/themes/twentytwentytwo/ReservaController.php?month=' + this.current_month + '&year=' + this.current_year
                await axios.get(url).then(res => {
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
                console.log('this.position ==> ', this.position);
            },
            start_day(){
                console.log('start_day ==> ');
                if(this.show_day < this.cant_days_month){
                    this.show_day++
                    if(this.show_day > this.position) {
                        return true
                    }else {
                        return false
                    }
                }
            },
            map_calendar(){
                let days = []
                for (let index = 0; index < this.cant_days_month; index++) {
                    days.push(index+1)
                }
                let calendar_vue = [[], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [],[],[],[], [], [], [], []]
                days.forEach((ele, index) => {
                    // console.log('%c entro a foreach', 'color:red;');
                    let date = new Date()
                    let month = date.getMonth() + 1
                    if(month < 10) month = '0' + month
                    if(ele < 10) ele = '0' + ele
                    date = date.getFullYear() + '-' + month + '-' + ele
                    this.calendar.forEach((row) => {
                        if(date == row.fecha) calendar_vue[index + this.position + 1].push(row)
                    });
                }) 
                let semana1 = calendar_vue.splice(1,7)
                let semana2 = calendar_vue.splice(1,7)
                let semana3 = calendar_vue.splice(1,7)
                let semana4 = calendar_vue.splice(1,7)
                let semana5 = calendar_vue.splice(1,7)
                this.calendar_vue = [semana1, semana2, semana3, semana4, semana5]
                console.log('calendar_vue ==> ', this.calendar_vue);
            },
            redirect(reserva, type){
                if(reserva.length > 0) {
                    window.location.href = "https://rutaapp.com/boats/wp-content/themes/twentytwentytwo/home.html?fecha=" + reserva[0].fecha
                }
            },
            details(reserva, type) {
                window.location.href = "https://rutaapp.com/boats/wp-content/themes/twentytwentytwo/ResumeReservaAdmin.html?reserva_id=" + reserva.id
                console.log('reserva_detail ==> ', reserva);
            },
            new_booking() {
                window.location.href = 'https://rutaapp.com/boats/reserva/'
            },
            dia_num_function() {
                // this.show_day++
                console.log('this.dia_num ==> ', this.dia_num);
                return this.dia_num++
            },
            next_month() {
                if(this.current_month < 12) {
                    this.current_month++
                }else{
                    this.current_month = 1
                    this.current_year++
                }
                this.show_day = 0
            },
            last_month() {
                if(this.current_month > 1) {
                    this.current_month--
                }else{
                    this.current_month = 12
                    this.current_year--
                }
                this.show_day = 0
            },
            func(){
                console.log('func ==> entro');
            },
            filtrar_por_barco() {
                this.show_day = 0
                axios.post('')
                console.log('this.filtros.vote_id ==> ', this.filtros.vote_id);
            },
            getBarcos() {
                // let url = 'https://rutaapp.com/boats/wp-content/themes/twentytwentytwo/ReservaController.php'
                let url = 'https://rutaapp.com/boats/wp-content/themes/twentytwentytwo/ReservaController.php'
                axios.get(url).then(res => {
                    this.botes = res.data.botes
                    this.calendar = res.data.calendar
                    this.map_calendar()
                })
            },
            }
}