export default {

    safeEndDate()
    {
        if (moment(this.end_date).isSameOrBefore(this.start_date)) {
            this.end_date = this.start_date;
            return this.end_date;
        }
        else {
            return this.end_date;
        }
    }
,
    safeEndTime()
    {
        return this.end_time;
    }


}