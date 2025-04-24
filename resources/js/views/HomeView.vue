<script setup>
import MainCarousel from '../components/MainCarousel.vue'
import TheVideo from '../components/TheVideo.vue'
import Results from '../components/Results.vue'
import Trust from '../components/Trust.vue'
import Reviews from '../components/Reviews.vue'
import Faq from '../components/Faq.vue'
import TheMap from '../components/Map.vue'
import ContactForm from '../components/ContactForm.vue'

import { useRoute, useRouter } from 'vue-router'
import { ref, reactive, computed, inject } from 'vue'


const openModal = inject('openModal')

//import { vAutofocus } from '@/directives/vAutofocus'
import Tarrifs from '@/components/Tarrifs.vue'
import { boolean } from 'yup'

const sectionTitle = 'выберите программу питания'
const program = ref('podderzhanie')
const changeProgram = (programName) => {
  program.value = programName
}


const summary = reactive({
  sum: 10320,
  program: 'ofis',
  qtyDays: 20
})

const finalSum = computed(() => {
  return summary.sum
})

/* const vAutofocus = {
  mounted: (el) => el.focus() 
}
 */

const route = useRoute()
const paymentStatus = route.query.payment
//console.log(paymentStatus)

if(paymentStatus) {
  const router = useRouter()
  router.push('/')
}

</script>

<template>
  <MainCarousel />

  <!-- <p v-if="$route.query.payment == 'success'">Успешно оплачен</p> -->
  
  <!-- Work -->
  <section class="work">
    <div class="main_container">
      <h2 class="main_title">Как это <span>работает?</span></h2>
      <ul class="d-flex flex-column flex-lg-row align-items-lg-start work__list">
        <li>
          <img src="@/assets/images/work-card-1.webp" alt="">
          <h3>Выбор тарифа</h3>
          <p>Вы выбираете тариф под ваши задачи с учетом всех необходимых параметров</p>
        </li>
        <li>
          <img src="@/assets/images/work-card-2.webp" alt="">
          <h3>Доставка</h3>
          <p>Мы бесплатно доставляем еду в любую точку города</p>
        </li>
        <li>
          <img src="@/assets/images/work-card-3.webp" alt="">
          <h3>питание</h3>
          <p>Вы питаетесь правильно, вкусно и разнообразно</p>
        </li>
        <li>
          <img src="@/assets/images/work-card-4.webp" alt="">
          <h3>экономия</h3>
          <p>Вы экономите 24 часа в неделю</p>
        </li>
        <li>
          <img src="@/assets/images/work-card-5.webp" alt="">
          <h3>Результат</h3>
          <p>2 недели питания и вы получаете результат</p>
        </li>
      </ul>
      <TheVideo file="vitameal39_720.mp4" />
    </div>
  </section>
  <!-- Work end -->

  <Tarrifs />

  <Results />

  <!-- Nutrition -->
  <section class="nutrition">
    <div class="d-flex flex-column align-items-center justify-content-center main_container nutrition__content">
      <div class="d-flex flex-column align-items-center justify-content-center nutrition__content_text text-center">
        <h3>Пробный день <br> правильного питания</h3>
        <h2>ВСЕГО ЗА 699₽!</h2>
        <ul>
          <li>
            <i class="icon icon-phone"></i> <span>Вы заказываете</span>
          </li>
          <li>
            <i class="icon icon-frying_pan"></i> <span>Мы готовим из свежих продуктов<br> на своем производстве </span>
          </li>
          <li>
            <i class="icon icon-track"></i> <span>Доставляем бесплатно в удобный день</span>
          </li>
          <li>
            <i class="icon icon-microwave"></i> <span>Все готово просто погреть</span>
          </li>
        </ul>
        <h4>начните свой путь к телу своей<br> мечты - попробуйте витамил!</h4>
        <a href="#" @click.prevent="openModal">заказать</a>
      </div>
      <img src="@/assets/images/nutrition-card-1.png" alt="" class="d-none d-lg-block card-1">
      <img src="@/assets/images/nutrition-card-1-sm.webp" alt="" class="d-lg-none card-1">
      <img src="@/assets/images/nutrition-card-2.webp" alt="" class="d-none d-lg-block card-2">
      <img src="@/assets/images/nutrition-card-2-sm.webp" alt="" class="d-lg-none card-2">
    </div>
  </section>
  <!-- Nutrition end -->

  <!-- Choose us -->
  <section class="choose-us">
    <div class="main_container">
      <img src="@/assets/images/choose-us-bg-2.webp" class="bg-2" alt="">
      <img src="@/assets/images/choose-us-bg-3.webp" class="bg-3" alt="">
      <img src="@/assets/images/choose-us-bg-1.webp" class="bg-1" alt="">
      <h2 class="main_title"><span>Почему</span> нас выбирают?</h2>
      <ul class="d-flex flex-wrap align-items-stretch choose-us__card">
        <li class="d-flex flex-column align-items-center choose-us__card_item">
          <img src="@/assets/images/choose-us-card-1.svg" alt="">
          <p>Правильный калораж и сочетание БЖУ</p>
        </li>
        <li class="d-flex flex-column align-items-center choose-us__card_item">
          <img src="@/assets/images/choose-us-card-2.svg" alt="">
          <p>Наш 6-ти летний опыт</p>
        </li>
        <li class="d-flex flex-column align-items-center choose-us__card_item">
          <img src="@/assets/images/choose-us-card-3.svg" alt="">
          <p>свежие продукты и контроль производства</p>
        </li>
        <li class="d-flex flex-column align-items-center choose-us__card_item">
          <img src="@/assets/images/choose-us-card-4.svg" alt="">
          <p>Более 1000 положительных отзывов</p>
        </li>
        <li class="d-flex flex-column align-items-center choose-us__card_item">
          <img src="@/assets/images/choose-us-card-5.svg" alt="">
          <p>Экономия до 24 часов в неделю</p>
        </li>
        <li class="d-flex flex-column align-items-center choose-us__card_item">
          <img src="@/assets/images/choose-us-card-6.svg" alt="">
          <p>Идеален для женщин</p>
        </li>
        <li class="d-flex flex-column align-items-center choose-us__card_item">
          <img src="@/assets/images/choose-us-card-7.svg" alt="">
          <p>Лучшая доставка Калининграда</p>
        </li>
        <li class="d-flex flex-column align-items-center choose-us__card_item">
          <img src="@/assets/images/choose-us-card-8.svg" alt="">
          <p>Разнообразное меню: более 140 блюд в месяц</p>
        </li>
      </ul>
    </div>
  </section>
  <!-- Choose us end -->

  <!-- Order -->
  <!-- <section class="order">
    <div class="d-flex flex-column justify-content-lg-center align-items-center align-items-lg-start main_container">
      <h3>закажите домашнюю <br> еду дешевле!</h3>
      <h2>МАМА ВАРИТ</h2>
      <p>Линейка блюд для тех, кто хочет вкусной домашней <br> еды, приготовленной с любовью!</p>
      <a href="https://mama-varit.ru/" class="btn_orange" target="_blank">ПОПРОБОВАТЬ</a>
      <img src="@/assets/images/order-card.png" alt="" class="d-none d-lg-block order__img">
      <img src="@/assets/images/order-card-sm.png" alt="" class="d-lg-none order__img">
    </div>
  </section> -->
  <!-- Order end -->

  <Faq />

  <TheMap phone="89992553890"  />

  <Reviews />

  <Trust />

  <!-- our_achievements -->
  <section class="our_achievements">
    <img class="our_achievements_bg" src="@/assets/images/our_achievements_bg.webp" alt="">
    <div class="main_container">
      <h3 class="main_title">Наши <span>достижения</span></h3>
      <div class="row our_achievements_cards">
        <div class="col-lg-4">
          <div class="our_achievements_card">
            <img src="@/assets/images/our_achievements_icon.svg" alt="">
            <h6>доставка № 1 в калининграде по версии Первого городского канала</h6>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="our_achievements_card">
            <img src="@/assets/images/our_achievements_icon.svg" alt="">
            <h6>Хорошее место от Яндекс - выбор пользователей 2023 года</h6>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="our_achievements_card">
            <img src="@/assets/images/our_achievements_icon.svg" alt="">
            <h6>Призер бизнес-премии первого городского канала</h6>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- our_achievements -->

  <ContactForm />
</template>