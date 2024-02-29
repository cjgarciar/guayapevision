<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                  Políticas de uso y privacidad para el uso de las herramientas digitales de Guayape TV
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 ">
                        <div class="p-6">
                            <div class="flex items-center">                                
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                  Política de privacidad
                                  </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm" style="text-align: justify">
                                  Guayape TV, está especialmente sensibilizada en la protección de datos de carácter personal de los usuarios de los servicios del sitio web guayapetv.hn y todos sus sub sitios derivados, así como también de la App oficial en sistemas Android y iOS.
                                </div>
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm" style="text-align: justify">
                                  Guayape TV, se reserva la facultad de modificar esta Política con el objeto de adaptarla a novedades legislativas, criterios jurisprudenciales, prácticas del sector, o intereses de la entidad. Cualquier modificación en la misma será anunciada con la debida antelación, a fin de que tengas perfecto conocimiento de su contenido.
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center">                                
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                  RESPONSABLE
                                  </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm" style="text-align: justify">
                                  El Responsable del Tratamiento de los datos de carácter personal es: Guayape TV.
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center">                                
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                  FINALIDAD DEL TRATAMIENTO
                                  </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm" style="text-align: justify">
                                  La finalidad de la recogida y tratamiento de los datos personales, a través de los formularios, según el caso concreto, para gestionar y atender a solicitudes de información, dudas o sugerencias. Finalmente informarles, que los datos registrados podrán ser utilizados con la finalidad de efectuar estadísticas, gestión de incidencias, además de para las que expresamente se hayan recabado los datos.
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center">                                
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                  PLAZO DE CONSERVACIÓN
                                  </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm" style="text-align: justify">
                                  Los datos personales proporcionados se conservarán durante el plazo correspondiente para cumplir con las obligaciones legales, o se solicite su supresión por el interesado y este esté legitimado para ello.
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center">                                
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                  LEGITIMACIÓN
                                  </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm" style="text-align: justify">
                                  Guayape TV, está legitimada al tratamiento de datos personales, en base al consentimiento otorgado por el interesado para uno o varios fines específicos, tal y como recoge el artículo 6.1. a) del Reglamento General de Protección de datos personales.
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center">                                
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                  DESTINATARIOS
                                  </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm" style="text-align: justify">
                                  Los usuarios garantizarán la veracidad y autenticidad de las informaciones y datos que comuniquen en virtud de la utilización de este sitio Web. Será obligación de los usuarios el mantener actualizados las informaciones y datos de forma tal que correspondan a la realidad en cada momento. Cualquier manifestación falsa o inexacta que se produzca como consecuencia de las informaciones y datos proporcionados, así como los perjuicios que tal información pudiera causar será responsabilidad de los usuarios. Los datos personales recabados a través de los formularios y cuestionarios electrónicos o, en su caso, impresos descargables no serán cedidos o comunicados a terceros, salvo en los supuestos necesarios para el desarrollo, control y cumplimiento de las finalidades/es expresada/s, en los supuestos previstos según Ley, así como en los casos específicos, de los que se informe expresamente al Usuario.
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center">                                
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                  DERECHOS DE LOS USUARIOS
                                  </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm" style="text-align: justify">
                                  El interesado de los datos personales, en todo caso podrá ejercitar los derechos que le asisten, de acuerdo con el IAIP, y que son:
Derecho a solicitar el acceso a los datos personales relativos al interesado,
Derecho a solicitar su rectificación o supresión,
Derecho a solicitar la limitación de su tratamiento,
Derecho a oponerse al tratamiento,
Derecho a la portabilidad de los datos.
El interesado podrá ejercitar tales derechos mediante solicitud acompañada de una fotocopia de su D.N.I, y en la que especificará cuál de éstos solicita sea satisfecho.
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                          <div class="flex items-center">                                
                              <div class="ml-4 text-lg leading-7 font-semibold">
                                MEDIDAS DE SEGURIDAD
                                </div>
                          </div>

                          <div class="ml-12">
                              <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm" style="text-align: justify">
                                Finalmente se informa que Guayape TV, adoptará en su sistema de información las medidas técnicas y organizativas legalmente requeridas, a fin de garantizar la seguridad y confidencialidad de los datos almacenados, evitando así, su alteración, pérdida, tratamiento o acceso no autorizado; teniendo en cuenta el estado de la técnica, los costes de aplicación, y la naturaleza, el alcance, el contexto y los fines del tratamiento, así como riesgos de probabilidad y gravedad variables asociadas a cada uno de los tratamientos.
                              </div>
                          </div>
                      </div>
                        

                        
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
