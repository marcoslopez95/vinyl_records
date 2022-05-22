<<template>
    <div>
        <BCard>
            <b-button variant="primary" @click="$router.go(-1)"
                >Regresar</b-button
            >
            <BRow class="mt-4">
            <BCol sm="1"></BCol>
            <BCol sm="4">
                <BCol >
                    <b-form-group
                        id="nombre"
                        label="Nombres"
                        label-for="nombre"
                        
                    >
                        <b-form-input
                            id="Nombre"
                            v-model="form.first_name"
                            @keypress="validarNombre()"
                            :state="validarNombre()"
                            aria-describedby="error-nombre"
                        ></b-form-input>
                         <b-form-invalid-feedback id="error-nombre">
                            El nombre debe tener al menos 2 caracteres
                        </b-form-invalid-feedback>
                    </b-form-group>
                </BCol>
                <BCol>
                    <b-form-group
                        id="apellido"
                        label="Apellidos"
                        label-for="apellido"
                    >
                        <b-form-input
                            id="apellido"
                            v-model="form.last_name"
                            @keypress="validarApellido()"
                            :state="validarApellido()"
                            aria-describedby="error"
                        ></b-form-input>
                         <b-form-invalid-feedback id="error">
                            El apellido debe tener al menos 2 caracteres
                        </b-form-invalid-feedback>
                    </b-form-group>
                </BCol>
                <BCol>
                    <b-form-group
                        id="email"
                        label="Correo Electrónico"
                        label-for="email"
                    >
                        <b-form-input
                            id="email"
                            type="email"
                            v-model="form.email"
                            @keypress="validarCorreo()"
                            :state="validarCorreo()"
                            aria-describedby="error"
                        ></b-form-input>
                         <b-form-invalid-feedback id="error">
                            El correo electrónico no es valido
                        </b-form-invalid-feedback>
                    </b-form-group>
                </BCol>
                <BCol>
                    <b-form-group id="phone" label="Telefono" label-for="phone">
                        <b-form-input
                            id="phone"
                            v-model="form.phone"
                            @keypress="validarTelefono()"
                            :state="validarTelefono()"
                            aria-describedby="error"
                        ></b-form-input>
                         <b-form-invalid-feedback id="error">
                            el Telefono debe ser mayor a 7 caracteres
                        </b-form-invalid-feedback>
                    </b-form-group>
                </BCol>
            </BCol>
                <BCol>
                    <div class="text-center">
                        <div>
                            <b-img
                                v-bind="mainProps"
                                rounded
                                alt="Rounded image"
                                v-if="preview == ''"
                            ></b-img>
                            <img
                                v-else
                                :src="preview"
                                rounded="circle"
                                alt="Circle image"
                                width="200px"
                                height="200px"
                            />
                        </div>
                        <div>
                            <input
                                v-show="true"
                                id="file"
                                required
                                type="file"
                                @change="previewImage($event)"
                            />
                        </div>
                    </div>
                </BCol>
            </BRow>

            <BRow class="mt-3">
                
            </BRow>
            <hr />
            <BRow>
                <BCol>
                    <b-form-select @change="form.tastes = []" :options="rols" v-model="form.rol_id"></b-form-select>
                </BCol>
            </BRow>
            <BRow>
                <BCol v-if="form.rol_id == 2">
                    <p>Seleccione sus gustos Musicales: </p>
                    <div class="form-check form-check-inline" v-for="(option,i) in tastes" :key="i">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            :id="'check'+i"
                            :value="option.item"
                            v-model="form.tastes"
                        />
                        <label class="form-check-label" :for="'check'+i">{{option.name}}</label>
                    </div>
                </BCol>
            </BRow>
            
            <hr />
            <BRow class="mt-2">
                <BCol sm="2">
                    <b-form-group
                        id="password"
                        label="Contraseña"
                        label-for="password"
                    >
                        <b-form-input
                            id="password"
                            type="password"
                            v-model="form.password"
                            @keypress="validarPassword()"
                            :state="validarPassword()"
                            aria-describedby="error"
                        ></b-form-input>
                         <b-form-invalid-feedback id="error">
                            Contraseña debe tener al menos 7 caracteres
                        </b-form-invalid-feedback>
                    </b-form-group>
                </BCol>
                <BCol sm="2">
                    <b-form-group
                        id="password_confirmation"
                        label="Confirmar Contraseña"
                        label-for="password_confirmation"
                    >
                        <b-form-input
                            type="password"
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            @keypress="validarPasswordConfirmation()"
                            :state="validarPasswordConfirmation()"
                            aria-describedby="error"
                        ></b-form-input>
                         <b-form-invalid-feedback id="error">
                            Las Contraseñas no coinciden
                        </b-form-invalid-feedback>
                    </b-form-group>
                </BCol>
            </BRow>
            <div class="text-center">
                <BButton variant="success" :disabled="!validarCampos()" @click="submit()"
                    >Guardar</BButton
                >
            </div>
        </BCard>
    </div>
</template>

<script>
import {
    BCard,
    BRow,
    BCol,
    BFormInput,
    BButton,
    BImg,
    BFormCheckboxGroup,
    BFormSelect,
    BFormGroup,
} from "bootstrap-vue";
import axios from "axios";

export default {
    components: {
        BCard,
        BFormSelect,
        BRow,
        BFormInput,
        BCol,
        BButton,
        BImg,
        BFormCheckboxGroup,
        BFormGroup,
    },
    data() {
        return {
            form: {
                first_name: "",
                last_name: "",
                phone: "",
                avatar_: "",
                email: "",
                password: "",
                password_confirmation: "",
                tastes: [],
                rol_id: "",
            },
            tastes: [],
            rols: [{ value: "", text: "Seleccione una opción" }],
            preview: "",
            validated: false,
            mainProps: {
                blank: true,
                blankColor: "#777",
                width: 200,
                height: 200,
                class: "m1",
            },
            token: "",
        };
    },
    mounted() {
        let token = localStorage.getItem("access_token");
        let type = localStorage.getItem("type_token");
        this.token = type + " " + token;
        this.getTastes();
        this.getRols();
    },
    updated() {
        //this.validarCampos();
    },
    methods: {
        validarCampos() {
            let bool =
                this.validarNombre() &&
                this.validarApellido() &&
                this.validarCorreo() &&
                this.validarTelefono() &&
                this.validarAvatar() &&
                this.validarTastes() &&
                this.validarPassword() &&
                this.validarPasswordConfirmation();
            console.warn("validarForm", bool);
            return bool;
        },
        validarRol() {
            if (this.form.rol_id == "") return null;
            let bool = this.form.rol_id != "";
            console.log("validarRol", bool);
            return bool;
        },
        validarPassword() {
            if (this.form.password == "") return null;
            let bool = this.form.password.length >= 7;
            console.log("validarpassword", bool);
            return bool;
        },
        validarPasswordConfirmation() {
            if (this.form.password_confirmation == "") return null;
            let bool = this.form.password === this.form.password_confirmation;
            console.log("validarpasswordConfri", bool);
            return bool;
        },
        validarTastes() {
            if (this.form.tastes.length == 0 && this.form.rol_id == "")
                return null;
            let bool;
            if (this.form.rol_id != 1 && this.form.rol_id != "") {
                bool = this.form.tastes.length != 0;
            } else if (this.form.rol_id == 1) {
                bool = true;
            }
            console.log("validarTastes", bool);
            return bool;
        },
        validarAvatar() {
            if (this.form.avatar_ == "") return null;
            let bool = this.form.avatar_ != "";
            console.log("validarAvatar", bool);
            return bool;
        },
        validarTelefono() {
            if (this.form.phone == "") return null;
            let bool = this.form.phone.length >= 7;
            console.log("validarTelefono", bool);
            return bool;
        },
        validarNombre() {
            if (this.form.first_name == "") return null;
            let bool = this.form.first_name.length >= 2;
            console.log("validarNombre", bool);
            return bool;
        },
        validarApellido() {
            if (this.form.last_name == "") return null;
            let bool = this.form.last_name.length >= 2;
            console.log("validarApellido", bool);
            return bool;
        },
        validarCorreo() {
            if (this.form.email == "") return null;
            var reLargo =
                "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@" +
                "[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";
            let bool =
                !this.form.email.search(reLargo) && this.form.correo != "";
            console.log("validarCorre", bool);
            return bool;
        },

        previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.form.avatar_ = this.preview = e.target.result;
                    //console.log("p", this.preview);
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        getTastes() {
            let url = "api/genres";
            let headers = {
                Authorization: this.token,
            };
            axios.get(url, { headers }).then((response) => {
                let data = response.data.data;
                data.forEach((element) => {
                    this.tastes.push({
                        item: element.id,
                        name: element.name,
                    });
                });
            });
        },
        getRols() {
            let url = "api/rols";
            let config = {
                headers: {
                    Authorization: this.token,
                },
            };
            axios.get(url, config).then((response) => {
                let data = response.data.data;
                data.forEach((element) => {
                    this.rols.push({
                        value: element.id,
                        text: element.name,
                    });
                });
            });
        },
        submit() {
            let config = {
                headers: {
                    Authorization: this.token,
                },
            };

            let url = "api/register";

            axios
                .post(url, this.form, config)
                .then((response) => {
                    let data = response.data.data;
                })
                .catch((error) => {
                    let e = error.response.data;
                });
        },
    },
};
</script>

<style>
</style>>