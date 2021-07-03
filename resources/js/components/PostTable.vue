<template>
    <v-app>
        <v-main>
            <v-card width="100%" class="shadow-none">
                <v-card-title>
                    <v-row class="m-1" justify="space-between">
                        Lista użytkowników i postów
                    </v-row>
                </v-card-title>

                    <v-data-table
                        :headers="headers"
                        :items="items"
                        :items-per-page="10"
                        class="elevation-0"
                        no-results-text="Brak wyników"
                        no-data-text="Brak danych"
                        :footer-props="footerProps"
                    >
                    </v-data-table>

                <v-card-actions class="flex justify-center"></v-card-actions>
            </v-card>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        props: ['items'],
        data() {
            return {
                headers: [
                    {
                        text: "Id",
                        value: "id",
                    },
                    {
                        text: 'Nazwa użytkownika',
                        value: "username",
                    },
                    {
                        text: 'Treść postu',
                        value: "body",
                    },
                ],
                footerProps: {
                    "items-per-page-text": "Wyświetl na stronie",
                    "items-per-page-options": [5, 10, 15, 30, 50, 100],

                },
            };
        },
        methods: {

        },
    }
</script>


