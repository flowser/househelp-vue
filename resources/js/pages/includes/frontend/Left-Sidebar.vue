<template>
    <div id="Left-Sidebar">
        <div class="left-sidebar">
            <h2>Filters</h2>
            <!-- {{Ages}} -->
            <aside class="widget widget_categories" style="padding-left: 5px; padding-top: 1px; padding-right: 5px;margin-bottom: 5px;">
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Age </label><br>
                    <!-- {{Ages}}<br> -->
                    <el-select
                        v-model="filterform.age"

                            clearable
                            placeholder="Select Age"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="age in Ages" :key="age.id"
                        v-show="age.househelps>0"
                        :label="age.name"
                        :value="age.name"> {{age.name}} years ({{age.househelps}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Gender </label><br>
                    <el-select
                        v-model="filterform.gender_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Gender"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="gender in Genders" :key="gender.id"
                        v-show="gender.househelps.length"
                        :label="gender.name"
                        :value="gender.id"> {{gender.name}} ({{gender.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Education </label><br>
                    <el-select
                        v-model="filterform.education_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Education"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="education in Educations" :key="education.id"
                        v-show="education.househelps.length"
                        :label="education.name"
                        :value="education.id"> {{education.name}} ({{education.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Experience </label><br>
                    <el-select
                        v-model="filterform.experience_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Experience"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="experience in Experiences" :key="experience.id"
                        v-show="experience.househelps.length"
                        :label="experience.name"
                        :value="experience.id"> {{experience.name}} ({{experience.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Maritalstatus </label><br>
                    <el-select
                        v-model="filterform.maritalstatus_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Maritalstatus"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="maritalstatus in Maritalstatuses" :key="maritalstatus.id"
                        v-show="maritalstatus.househelps.length"
                        :label="maritalstatus.name"
                        :value="maritalstatus.id"> {{maritalstatus.name}} ({{maritalstatus.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Tribe </label><br>
                    <el-select
                        v-model="filterform.tribe_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Tribe"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="tribe in Tribes" :key="tribe.id"
                        v-show="tribe.househelps.length"
                        :label="tribe.name"
                        :value="tribe.id"> {{tribe.name}} ({{tribe.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Skill </label><br>
                    <el-select
                        v-model="filterform.skill_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Skill"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="skill in Skills" :key="skill.id"
                        v-show="skill.househelps.length"
                        :label="skill.name"
                        :value="skill.id"> {{skill.name}} ({{skill.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Operation </label><br>
                    <el-select
                        v-model="filterform.operation_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Operation"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="operation in Operations" :key="operation.id"
                        v-show="operation.househelps.length"
                        :label="operation.name"
                        :value="operation.id"> {{operation.name}} ({{operation.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Duration </label><br>
                    <el-select
                        v-model="filterform.duration_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Duration"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="duration in Durations" :key="duration.id"
                        v-show="duration.househelps.length"
                        :label="duration.name"
                        :value="duration.id"> {{duration.name}} ({{duration.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Religion </label><br>
                    <el-select
                        v-model="filterform.religion_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Religion"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="religion in Religions" :key="religion.id"
                        v-show="religion.househelps.length"
                        :label="religion.name"
                        :value="religion.id"> {{religion.name}} ({{religion.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Kid </label><br>
                    <el-select
                        v-model="filterform.kid_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Kid"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="kid in Kids" :key="kid.id"
                        v-show="kid.househelps.length"
                        :label="kid.name"
                        :value="kid.id"> {{kid.name}} ({{kid.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>English Status </label><br>
                    <el-select
                        v-model="filterform.englishstatus_id"
                            clearable
                            multiple
                            filterable
                            placeholder="Select Englishstatus"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="englishstatus in Englishstatuses" :key="englishstatus.id"
                        v-show="englishstatus.househelps.length"
                        :label="englishstatus.name"
                        :value="englishstatus.id"> {{englishstatus.name}} ({{englishstatus.househelps.length}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>ID Status </label><br>
                    <el-select
                        v-model="filterform.idstatus"
                            clearable
                            multiple
                            filterable
                            placeholder="Select IDstatus"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="idstatus in IDstatuses" :key="idstatus.id"
                        v-show="idstatus.househelps>0"
                        :label="idstatus.name"
                        :value="idstatus.name"> {{idstatus.name}} ({{idstatus.househelps}})
                        </el-option>
                    </el-select>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-6" style="padding-right: 5px;padding-left: 5px;">
                    <label>Health Status </label><br>
                    <el-select
                        v-model="filterform.healthstatus"
                            clearable
                            multiple
                            filterable
                            placeholder="Select IDstatus"
                            @change="remoteMethod"
                            :loading="loading">
                        <el-option
                        v-for="healthstatus in Healthstatuses" :key="healthstatus.id"
                        v-show="healthstatus.househelps>0"
                        :label="healthstatus.name"
                        :value="healthstatus.name"> {{healthstatus.name}} ({{healthstatus.househelps}})
                        </el-option>
                    </el-select>
                </div>

                <hr class="col-md-12 col-xs-12 col-sm-12" style="padding-right: 0px;padding-left: 0px;">
            </aside>
		</div>

    </div>
</template>

<script>
export default {
    name:"Left-Sidebar",
     data(){
            return{
                loading: false,
                filterform:new Form({
                    age:'',
                    gender_id:'',
                    education_id:'',
                    experience_id:'',
                    maritalstatus_id:'',
                    tribe_id:'',
                    skill_id:'',
                    operation_id:'',
                    duration_id:'',
                    religion_id:'',
                    kid_id:'',
                    englishstatus_id:'',
                    idstatus:'',
                    healthstatus:'',
                }),
            }
        },
        mounted() {
            this.loadDurations();
            this.loadEducations();
            this.loadEnglishstatuses();
            this.loadExperiences();
            this.loadKids();
            this.loadMaritalstatuses();
            this.loadOperations();
            this.loadReligions();
            this.loadSkills();
            this.loadTribes();
            this.loadGenders();
            this.loadIDstatuses();
            this.loadHealthstatuses();
            this.loadAges();
        },
        computed:{
            Ages(){
               return this.$store.getters.Ages
            },
            Genders(){
               return this.$store.getters.Genders
            },
            Educations(){
               return this.$store.getters.Educations
            },
            Durations(){
               return this.$store.getters.Durations
            },
            Englishstatuses(){
               return this.$store.getters.Englishstatuses
            },
            Experiences(){
               return this.$store.getters.Experiences
            },
            Kids(){
               return this.$store.getters.Kids
            },
            Maritalstatuses(){
               return this.$store.getters.Maritalstatuses
            },
            Operations(){
               return this.$store.getters.Operations
            },
            Religions(){
               return this.$store.getters.Religions
            },
            Skills(){
               return this.$store.getters.Skills
            },
            Tribes(){
               return this.$store.getters.Tribes
            },
            IDstatuses(){
               return this.$store.getters.Idstatuses
            },
            Healthstatuses(){
               return this.$store.getters.Healthstatuses
            },
            Househelps(){
                return this.$store.getters.Househelps
            }
        },
        methods:{
            loadAges(){
                return this.$store.dispatch("ages")
            },
            loadGenders(){
               return this.$store.dispatch("genders")
            },
            loadRelationships(){
               return this.$store.dispatch("relationships")
            },
            loadEducations(){
               return this.$store.dispatch("educations")
            },
            loadDurations(){
               return this.$store.dispatch("durations")
            },
            loadEnglishstatuses(){
               return this.$store.dispatch("englishstatuses")
            },
            loadExperiences(){
               return this.$store.dispatch("experiences")
            },
            loadKids(){
               return this.$store.dispatch("kids")
            },
            loadMaritalstatuses(){
               return this.$store.dispatch("maritalstatuses")
            },
            loadOperations(){
               return this.$store.dispatch("operations")
            },
            loadReligions(){
               return this.$store.dispatch("religions")
            },
            loadSkills(){
               return this.$store.dispatch("skills")
            },
            loadTribes(){
               return this.$store.dispatch("tribes")
            },
            loadIDstatuses(){
                return this.$store.dispatch("idstatuses")
            },
            loadHealthstatuses(){
                return this.$store.dispatch("healthstatuses")
            },
            HousehelpsByGenderID(id){
                this.filterform.gender_id = id;
                this.$store.dispatch("HousehelpsByFilter",
                     this.filterform
                 )
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Househlp Filtration search was been successful'
                            })
                            // this.$store.dispatch("househelps")
                            this.filterform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            toast({
                                type: 'error',
                                title: 'Househlp Filtration search was not successful, change your Filters.'
                                })
                    });
            },
            HousehelpsByEducationID(id){
               this.filterform.education_id = id;
                this.$store.dispatch("HousehelpsByFilter",
                     this.filterform
                 )
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Househlp Filtration search was been successful'
                            })
                            // this.$store.dispatch("househelps")
                            this.filterform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            toast({
                                type: 'error',
                                title: 'Househlp Filtration search was not successful, change your Filters.'
                                })
                    });
            },
            HousehelpsByDurationID(id){
                this.filterform.duration_id = id;
                this.$store.dispatch("HousehelpsByFilter",
                     this.filterform
                 )
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Househlp Filtration search was been successful'
                            })
                            // this.$store.dispatch("househelps")
                            this.filterform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            toast({
                                type: 'error',
                                title: 'Househlp Filtration search was not successful, change your Filters.'
                                })
                    });
            },
            HousehelpsByExperienceID(id){
                this.filterform.experience_id = id;
                this.$store.dispatch("HousehelpsByFilter",
                     this.filterform
                 )
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Househlp Filtration search was been successful'
                            })
                            // this.$store.dispatch("househelps")
                            this.filterform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            toast({
                                type: 'error',
                                title: 'Househlp Filtration search was not successful, change your Filters.'
                                })
                    });
            },
            HousehelpsByMaritalstatusID(id){
                this.filterform.maritalstatus_id = id;
                this.$store.dispatch("HousehelpsByFilter",
                     this.filterform
                 )
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Househlp Filtration search was been successful'
                            })
                            // this.$store.dispatch("househelps")
                            this.filterform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            toast({
                                type: 'error',
                                title: 'Househlp Filtration search was not successful, change your Filters.'
                                })
                    });
            },
            HousehelpsByOperationID(id){
                this.filterform.operation_id = id;
                this.$store.dispatch("HousehelpsByFilter",
                     this.filterform
                 )
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Househlp Filtration search was been successful'
                            })
                            // this.$store.dispatch("househelps")
                            this.filterform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            toast({
                                type: 'error',
                                title: 'Househlp Filtration search was not successful, change your Filters.'
                                })
                    });
            },
            HousehelpsBySkillID(id){
                this.filterform.skill_id = id;
                this.$store.dispatch("HousehelpsByFilter",
                     this.filterform
                 )
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Househlp Filtration search was been successful'
                            })
                            // this.$store.dispatch("househelps")
                            this.filterform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            toast({
                                type: 'error',
                                title: 'Househlp Filtration search was not successful, change your Filters.'
                                })
                    });
            },
            HousehelpsByReligionID(id){
                this.filterform.religion_id = id;
                console.log('religion', this.filterform.religion_id)
                // this.$store.dispatch("HousehelpsByReligionID", +id)
                this.$store.dispatch("HousehelpsByFilter",
                     this.filterform
                 )
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Househlp Filtration search was successful'
                            })
                            // this.$store.dispatch("househelps")
                            this.filterform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            toast({
                                type: 'error',
                                title: 'Househlp Filtration search was not successful, change your Filters.'
                                })
                    });
            },
            HousehelpsByTribeID(id){
                this.filterform.tribe_id = id;
                this.$store.dispatch("HousehelpsByFilter",
                     this.filterform
                 )
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Househlp Filtration search was been successful'
                            })
                            // this.$store.dispatch("househelps")
                            this.filterform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            toast({
                                type: 'error',
                                title: 'Househlp Filtration search was not successful, change your Filters.'
                                })
                    });
            },
            allHousehelps(){
                return this.$store.dispatch("househelps")
            },
            remoteMethod(query) {
                this.$Progress.start()
                this.$store.dispatch("HousehelpsByFilter", this.filterform)
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'Househelp Filtration search has been successful'
                        })
                        //   this.filterform.reset()
                          this.$Progress.finish()
                })
                .catch(()=>{
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        title: 'Househelp Filtration search was not successful, change your Filters.'
                    })
                })
                // var vm = this
                // if (query !== '') {
                //     axios.get('/api/search?search=' + query).then(function (query) {
                //         vm.options4 = query.data.map(item => {
                //             return {value: item.id, label: item.name};
                //         })
                //     })
                // } else {
                //     vm.options4 = [];
                // }
            },
        }
}
</script>

<style>

</style>
