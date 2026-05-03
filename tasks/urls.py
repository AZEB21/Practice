from django.urls import path
from . import views

urlpatterns = [
    path('', views.task_list, name='task-list'),
    path('create/', views.create_task, name='create-task'),
    path('update/<int:task_id>/', views.update_task, name='update-task'),
   # path('delete/<int:task_id>/', views.delete_task, name='delete-task'),
   path('github/', views.create_github),
path('sport/', views.create_sport),
path('music/', views.create_music),
]